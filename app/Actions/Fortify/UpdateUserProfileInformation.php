<?php

namespace App\Actions\Fortify;

use App\Actions\FileUpload;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function __construct(
        protected FileUpload $fileUpload,
    ) {}

    /**
     * Validate and update the user's profile information.
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],

            'bio' => ['nullable', 'string', 'min:3', 'max:255'],

            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:1024',
            ],
        ])->validateWithBag('updateProfileInformation');

        // Remove current profile picture
        if (! empty($input['remove_profile_picture'])) {
            $this->deleteProfilePicture($user);
            $input['profile_picture'] = null;
        }
        // Upload a new profile picture
        else {
            $profilePicture = $this->fileUpload->handle(
                key: 'profile_picture',
                path: 'profile-pictures'
            );

            if ($profilePicture) {
                $this->deleteProfilePicture($user);
                $input['profile_picture'] = $profilePicture;
            } else {
                unset($input['profile_picture']);
            }
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);

            return;
        }

        $this->updateUser($user, $input);
    }

    /**
     * Update a verified user who changed their email.
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'bio' => $input['bio'] ?? null,
            'profile_picture' => array_key_exists('profile_picture', $input)
                ? $input['profile_picture']
                : $user->profile_picture,
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * Update a regular user.
     */
    protected function updateUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'bio' => $input['bio'] ?? null,
            'profile_picture' => array_key_exists('profile_picture', $input)
                ? $input['profile_picture']
                : $user->profile_picture,
        ])->save();
    }

    /**
     * Delete the current profile picture if it exists.
     */
    protected function deleteProfilePicture(User $user): void
    {
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
    }
}
