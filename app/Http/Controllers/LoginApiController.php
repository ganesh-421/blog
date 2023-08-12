<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{
    //
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => "validation error",
            ]);
        }
        if(!auth()->attempt($validator->validated())) {
            return response()->json([
                'message' => "you can't be authorized via provided credentials",
            ], 401);
        }
        $token = auth()->user()->createToken('authToken')->plainTextToken;
        return response()->json([
            'name' => auth()->user()->name,
            'token' => $token,
        ]);
    }
}
