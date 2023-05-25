<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /**
     * waits for the user to verify their email
     * shows a notice to the user with resend link button
     */
    public function show()
    {
        return view('auth.notice');
    }
    /**
     * send verification email to the user and redirect back with a message
     */
    public function store()
    {
        request()->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
    /**
     * verify the user email
     * if the user is already verified redirect to home page
     * if the user is not verified mark the user as verified and redirect to home page
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }
        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return redirect($this->redirectPath())->with('verified', true);
    }
    public function redirectPath()
    {
        if (!request()->user()->is_verified) {
            return route('verification.notice');
        }
        return route('home');
    }
}