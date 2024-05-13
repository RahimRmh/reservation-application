<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Laravel\Passport\HasApiTokens;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Str;

use App\Http\Resources\user as UserResource;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        // Validate incoming request data
        $validatedData = $request->validated();

        // Hash the password before saving it to the database for security
         $validatedData['password'] = Hash::make($validatedData['password']);

         $validatedData['verification_code'] =  mt_rand(100000, 999999) ;
        // Create a new user in the database 
        $user = User::create($validatedData);

        Mail::to($user->email)->send(new VerificationCodeMail($user));

    
        // Create an access token for the user
        $accessToken = $user->createToken('Access Token')->accessToken;
    
        // Return a JSON response with the user data and access token
        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $accessToken,
            'message' => 'User registered successfully' // Add a message to indicate successful registration
        ], 200);
    }
    
}
