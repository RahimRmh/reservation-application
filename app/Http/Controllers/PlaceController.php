<?php

namespace App\Http\Controllers;

use App\Models\place;

use Illuminate\Http\Request ;
use App\Http\Resources\place as PlaceResource;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
      
        $this->middleware('auth:api')->except('index');     }

    public function index(Request $request)
    {
        // $limit = $request->input('limit')<= 7? $request->input('limit') : 2 ;
        $places =  PlaceResource::collection(place::paginate(1));
        return $places->response()->setStatusCode(200,'places returned successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',place::class);
        $data=request()->validate(['name' => 'required']);

       $place = new PlaceResource(place::create($data));

       return $place->response()->setStatusCode(200,'place created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $place = new PlaceResource(place::findOrFail($id));
        return $place->response()->setStatusCode(200,'place returned successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(place $place)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $this->authorize('update',place::class);

        $data=request()->validate(['name' => 'required']);

        $place=new PlaceResource(place::findOrFail($id));
         $place->update($request->all());
         return $place->response()->setStatusCode(200,'place updated ');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete',place::class);

        $place=place::findOrFail($id);
        $place->delete();
       return response(['message' => 'place deleted'])->setStatusCode(200,'place deleted successfully');

    }
}
