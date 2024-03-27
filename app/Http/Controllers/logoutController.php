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
  public function __construct()
  {
   
      $this->middleware('auth:api');
  }

    public function logout(Request $request)
    {
      

      $token = $request->user()->tokens();
      $token->delete();
      $response = ['message' => 'You have been successfully logged out'];
      return response($response,200);

    }
}
