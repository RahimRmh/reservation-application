<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\user;
use App\Models\reservation;
use Illuminate\Http\Request;
use App\Http\Resources\reservation as ReservationResource;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
     {
        $this->middleware('auth:api')->except('index');     }

    public function index(Request $request)
    { 
           // $limit = $request->input('limit')<= 50? $request->input('limit') : 1 ;
         // Returning JSON response with reservations and a success message
        return response()->json([
        'reservations' => ReservationResource::collection(reservation::paginate(2)), 
        'message' => 'reservations returned successfully'
        ],200);
    }

 
    public function store(StoreReservationRequest $request)
    {       
         // Validate incoming request data
        $validatedData = $request->validated();

             
        // Assign the user ID of the authenticated user to the reservation
       $validatedData['user_id']= auth()->id();
                
       // Create a new reservation instance and save it to the database
       $reservation = new ReservationResource(reservation::create($validatedData)) ;

        // Return a JSON response indicating successful reservation creation
       return response()->json(['reservation' => $reservation,
                                'message' => 'Reservation created successfully']);





    }

 
     public function show( $id)
     {
         // Return a JSON response with selected reservation  and status code
         return response()->json(["THE Reservation"=>new ReservationResource(reservation::findorFail($id))
         ,'message' => 'Reservation returned successfully'],200);
     }
  

    public function update(UpdateReservationRequest $request,  $id)
    {
         // Validate incoming request data
         $validatedData = $request->validated();

         // Find the reservation by its ID or throw an exception
        $reservation =  Reservation::findorFail($id);

         // Authorize the update action
        $this->authorize('update',$reservation);

        // Assign the authenticated user's ID to the reservation
        $validatedData['user_id'] = auth()->id();

        // Update the reservation with the validated data
          $reservation->update($validatedData);

       // Return a JSON response with the updated reservation and status code
       return response()->json(['reservation'=> new ReservationResource($reservation),
                                'message' => 'Reservations updated successfully'],200);
}


    
 
        public function destroy($id)
    {   // Find the reservation by its ID or throw an exception
        $reservation =  Reservation::findorFail($id);
        
         // Authorize the delete action
        $this->authorize('delete',$reservation);
  
        $reservation->delete();    
       // Return a JSON response with delete reservation message and status code
         return response()->json(['message' => 'reservation deleted'],200);


    }
}
