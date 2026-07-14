<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, User $user)
    {
        // Ensure the authenticated user can only delete their own account
        if ($request->user()->id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete profile picture if it exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Log out the user
        Auth::logout();

        // Delete the user record
        $user->delete();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Your account has been deleted successfully.');
    }
}
