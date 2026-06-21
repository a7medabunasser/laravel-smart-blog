<?php

namespace App\Responses;

use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse as ProfileInformationUpdatedResponseContract;

class ProfileInformationUpdatedResponse implements ProfileInformationUpdatedResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('dashboard.profile.info')
            ->with('message', 'Profile updated successfully!');
    }
}
