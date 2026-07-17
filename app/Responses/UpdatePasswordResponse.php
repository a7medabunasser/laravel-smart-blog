<?php

namespace App\Responses;

use Laravel\Fortify\Contracts\PasswordUpdateResponse as PasswordUpdateResponseContract;

class UpdatePasswordResponse implements PasswordUpdateResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        return redirect(route('dashboard.profile.info'))->with([
            'status' => 'Password updated successfully!',
        ]);
    }
}
