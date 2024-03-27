<?php

namespace App\Http\Controllers;

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
        $reservations = ReservationResource::collection(reservation::paginate(2));
        return response(['message' => $reservations])->setStatusCode(200,'reservations returned successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $data = request()->validate([
       
        'resturant_id' =>  'integer|required',
        'start_date'   =>  'required|date'  ,
        'quantity'     =>  'integer|required',
        'notes' => 'nullable|string|max:255'
      ]);
      
       $data['user_id']= auth()->id();
          
       $reservation = new ReservationResource(reservation::create($data)) ;

       return $reservation->response()->setStatusCode(200,'reservation created');





    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $reservation = new ReservationResource(reservation::findOrFail($id));
        return $reservation->response()->setStatusCode(200,'reservation returned successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
         $idreservation = reservation::findOrFail($id);
        $this->authorize('update',$idreservation);
        $reservation=new ReservationResource(reservation::findOrFail($id));
         $reservation->update($request->all());
         return $reservation->response()->setStatusCode(200,'reservation updated successfully');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {          
        $idreservation = reservation::findOrFail($id);
        $this->authorize('delete',$idreservation);

        $reservation = reservation::findOrFail($id) ;
        $reservation->delete();
        return response(['message' => 'reservation deleted'])->setStatusCode(200,'place deleted successfully');


    }
}
