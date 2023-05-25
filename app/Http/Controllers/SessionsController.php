<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;


class SessionsController extends Controller
{
    /**
     * logout the user
     */
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
    /**
     * return a view to login the user
     */
    public function create()
    {
        return view("sessions.create");
    }
    /**
     * login the user
     * check if the user is verified or not
     */
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // attempt to authenticate and login the user
        // based on provided credentials
        // auth does check if user is logged in or not and also check if the provided
        // ---are correct or not.
        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => "Provided email doesn't exists",
                'password' => "Provided password is wrong"
            ]);
        }
        if (!auth()->user()->is_verified) {
            throw ValidationException::withMessages([
                'email' => "Your email is not verified, please check your email for verification link."
            ]);
        }
        session()->regenerate(); //eliminate session fixation
        return redirect("/")->with('success', "Welcome Back!");
    }
}