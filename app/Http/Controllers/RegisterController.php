<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;

class RegisterController extends Controller
{
    /**
     * return the registration form
     */
    public function create()
    {
        return view('register.create');
    }
    /**
     * validate the form data
     * create a new user
     * send verification email by firing an event
     * log the user in
     * redirect to home page
     */
    public function store()
    {
        // return(request()->all());
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            // 'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username)]
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255'
        ]);
        $user = User::create($attributes);
        event(new Registered($user));
        auth()->login($user);
        return redirect("/")
            ->with('success', 'Your account has been created successfully, 
                    check your email for verification and proceed login.');
    }
}