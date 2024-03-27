<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\user as UserResource;

class usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
             $this->middleware('auth:api')->except('index');
    }
    
    public function index(Request $request)
    {
        $limit = $request->input('limit')<= 38? $request->input('limit') : 10 ;
        $users=  UserResource::collection(User::paginate($limit));
        return $users->response()->setStatusCode(200,'Users returned successfully');
    }


    public function show( $id)
    {
        $user = new UserResource( User::findorFail($id));
        return $user->response()->setStatusCode(200, 'User returned successfully');
    }

    public function store(Request $request)
    {
        $this->authorize('create',User::class);
   
       

    
    
      $user=  new UserResource(User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password)
       ]));
       
    return $user->response();
    
    
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $iduser= User::findorFail($id);
        $this->authorize('update', $iduser);
    //     $data=request()->validate
    //     ([
    //     'name'=>'required',
    //     'email'=>'required|email',
    //    ]);
        $user = new UserResource( User::findorFail($id));
         $user->update($request->all());
         return $user->response()->setStatusCode(200, 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id ) 
    {
        $iduser=User::findOrFail($id);
        $this->authorize('delete',$iduser);
        $user=User::findOrFail($id);
        $user->delete();   
        return response(['message' => 'user deleted'],200);

     }


}
