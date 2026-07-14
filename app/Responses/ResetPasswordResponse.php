<?php

namespace App\Responses;

use Laravel\Fortify\Contracts\ResetPasswordResponse as ResetPasswordResponseContract;

class ResetPasswordResponse implements ResetPasswordResponseContract
{
    public function toResponse($request)
    {
        return redirect(route('login'))->with('status', 'Password reset successfully!');
    }
}
