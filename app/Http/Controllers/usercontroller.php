<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\user as UserResource;

class usercontroller extends Controller
{

    public function update(UpdateUserRequest $request, $id)
    {
        // Find the user by their ID
        $user = User::findOrFail($id);
    
        // Check if the current user is authorized to update this user
        $this->authorize('update', $user);
    
        // Update the user with the validated data from the request
        $user->update($request->validated());
    
        // Return a JSON response with the updated user and a success message
        return response()->json([
            'user' => new UserResource($user), // Convert the user to a resource for formatting
            'message' => 'User updated successfully'
        ], 200);
    }
    


    public function destroy($id)
    {
        // Find the user by their ID
        $user = User::findOrFail($id);
    
        // Check if the current user is authorized to delete this user
        $this->authorize('delete', $user);
    
        // Delete the user from the database
        $user->delete();
    
        // Return a JSON response indicating successful deletion
        return response()->json(['message' => 'User deleted'], 200);
    }
    


}
