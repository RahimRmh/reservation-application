<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\user as UserResource;



class RegisterController extends Controller
{
    // public function __construct()
    // {
     
    //     $this->middleware('auth.basic.once');
    // }
    public function Register(Request $request)
    {
  
   
        $validator=validator::make($request->all(),
        [
            'name'=> 'required|min:4|unique:users',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

    if($validator->fails()){
        return response([$validator->errors()],422);
    }
    
      $user=  new UserResource(User::create([
        'name'=> $request['name'],
        'email'=> $request['email'],
        'password'=> Hash::make($request['password'])
       ]));
       $Accesstoken=$user->createToken('Access Token')->accessToken;
       return response(['user'=>$user,
        'Access Token'=>$Accesstoken]);
    
    
    
    }
}
