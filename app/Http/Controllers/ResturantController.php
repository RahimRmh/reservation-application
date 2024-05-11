<?php

namespace App\Http\Controllers;

use App\Models\resturant;
use App\Http\Requests\StoreresturantRequest;
use App\Http\Requests\UpdateresturantRequest;
use App\Http\Resources\resturant as ResturantResource;
use App\Models\place;
use Illuminate\Http\Request;

class ResturantController extends Controller
{
    

     public function __construct()
     {
        $this->middleware('auth:api')->except('index');     }

    public function index()
    {
        // Returning JSON response with restaurants and a success message
        return response()->json([
            'resturants' => ResturantResource::collection(resturant::paginate(10)), 
            'message' => 'Resturants returned successfully'
         ],200);

    }

  
    public function store(StoreresturantRequest $request)
    {   
         // Authorize the request to ensure the user has permission to create a restaurant.
        $this->authorize('create',resturant::class);

          // Return a JSON response with the newly created restaurant and a success message.
        return response()->json([
            'resturant' => new ResturantResource(resturant::create($request->validated())), 
            'message' => 'Resturant created successfully'
         ],200);
    }

    public function show( $id )
    {

        return response()->json([
            'resturant' => new ResturantResource(resturant::findorFail($id)), // Retrieve the restaurant by its ID
            'message' => 'Restaurant returned successfully' // Provide a success message
        ], 200);
        
        
    }


    public function update(UpdateresturantRequest $request, $id)
    {
       // Authorize the request to ensure the user has permission to update a restaurant.
       $this->authorize('update', Resturant::class);

       // Retrieve the restaurant by its ID and create a new resource instance.
        $resturant = new ResturantResource(resturant::findorFail($id));

        // Update the restaurant using the validated data from the request.
        $resturant->update($request->validated());

      // Return a JSON response with the updated restaurant and a success message.
          return response()->json([
          'resturant' => $resturant,
        'message' => 'Restaurant updated successfully'
                      ], 200);

    }

  
    public function destroy( $id)
    {           
                // Authorize the request to ensure the user has permission to delete a restaurant.
                $this->authorize('delete', Resturant::class);

                 // Find the restaurant by its ID and delete it.
                resturant::findOrFail($id)->delete();

                // Return a JSON response with a success message.
               return response()->json(['message' => 'Restaurant deleted successfully'], 200);

          
    }

    public function ResturantsAccordingToPlace($placeId)
    {
        // Find the place by its ID.
        $place = place::find($placeId);
    
        // Return a JSON response with the restaurants directly.
        return response()->json([
            'resturants' => ResturantResource::collection($place->resturants()->get()),
            'message' => 'Restaurants returned successfully'
        ], 200);
    }
    

                                     
              
                                     

    }

