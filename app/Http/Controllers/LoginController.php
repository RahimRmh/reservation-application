<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\user as UserResource;


class LoginController extends Controller
{

   
    public function login(LoginRequest $request)
{
    // Validate incoming request data
    $validatedData = $request->validated();
    
    // Check if a user exists with the provided email
    $user = User::where('email', $validatedData['email'])->first();

    // If user exists, proceed with password check
    if ($user) {
        // Verify the password
        if (Hash::check($validatedData['password'], $user->password)) {
            // If password matches, generate and return access token along with user data
            return response()->json([
                'Token' => $user->createToken('Access Token')->accessToken,
                'user' => new UserResource($user)
            ], 200);
        } else {
            // If password doesn't match, return response indicating password mismatch
            return response()->json(['password' => 'Password mismatch'], 422);
        }
    } else {
        // If user not found, return response indicating user not found
        return response()->json(['message' => 'User not found'], 422);
    }
}

}

