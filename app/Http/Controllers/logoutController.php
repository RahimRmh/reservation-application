<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Validator;

class logoutController extends Controller
{


    public function logout(Request $request)
    {
      // Deleting all tokens associated with the authenticated user
       $request->user()->tokens()->delete();

      // Returning a JSON response with a success message
            return response()->json([
                 'message' => 'You have been successfully logged out' // Success message
                            ], 200);


    }
}
