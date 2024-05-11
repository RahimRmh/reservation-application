<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreplaceRequest;
use App\Http\Requests\UpdateplaceRequest;
use App\Models\place;
use Illuminate\Http\Request ;
use App\Http\Resources\place as PlaceResource;

class PlaceController extends Controller
{

    public function index(Request $request)
    {
        // $limit = $request->input('limit')<= 7? $request->input('limit') : 2 ;
        return response()->json([
            'places' => PlaceResource::collection(place::paginate(1)), // Retrieve places and format them using PlaceResource
            'message' => 'Places returned successfully' // Success message
        ], 200);
        
    }

    public function store(StoreplaceRequest $request)
    {
        // Authorize the creation of a new place
        $this->authorize('create',place::class);

        // Return a JSON response with the created place and a success message
       return response()->json(['place' => new PlaceResource(place::create($request->validated())) ,
                                'message' => 'place created successfully'
                            ],200);
    
    }

    public function show( $id)
    {
               // Return a JSON response with the found place and a success message
                return response()->json(['place' => new PlaceResource(place::findOrFail($id)),
                'message' => 'place returned successfully'],200);
    }

    public function update(UpdateplaceRequest $request, $id)
{
    // Authorize the update action for places
    $this->authorize('update', place::class);

    // Find the place by its ID and wrap it in a PlaceResource
    $place = new PlaceResource(place::findOrFail($id));

    // Update the place with the validated data from the request
    $place->update($request->validated());

    // Return a JSON response with the updated place and a success message
    return response()->json([
        'The place' => $place, 
        'message' => 'Place updated successfully' 
    ], 200);
}


    public function destroy($id)
    {
        // Authorize the delete action for places
        $this->authorize('delete', place::class);
    
        // Find the place by its ID and delete it
        place::findOrFail($id)->delete();
    
        // Return a JSON response indicating successful deletion
        return response()->json([
            'message' => 'Place deleted successfully' 
        ], 200);
    }
    
}
