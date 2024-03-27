<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\user as UserResource;


class LoginController extends Controller
{
   
   
    public function login(Request $request){
        $validator=validator::make($request->all(),
        [
            'email'=> 'required|email',
            'password'=>'required|unique:users|min:5'
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()->all()],422);
        }
        $user=new UserResource( User::where('email',$request->email)->first());
        //user check
        if($user){
             //password check
            if(Hash::check($request->password,$user->password)){

                $Accesstoken=$user->createToken('Access Token')->accessToken;
                $response=['Token'=>$Accesstoken , 'User'=> $user];
                return response($response , 200);

            }
            else{
                $response = ['password'=> 'password mismatch'];
                return response($response,422);
            }
        }


        else{
            $response = ['message' => 'user not found'];
            return response($response , 422);

        }

        
    }
}
