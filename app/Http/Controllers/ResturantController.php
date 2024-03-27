<?php

namespace App\Http\Controllers;

use App\Models\resturant;
use App\Http\Requests\StoreresturantRequest;
use App\Http\Requests\UpdateresturantRequest;
use App\Http\Resources\resturant as ResturantResource;
use Illuminate\Http\Request;

class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        $this->middleware('auth:api')->except('index');     }

    public function index(Request $request)
    {
        $limit = $request->input('limit')<= 20? $request->input('limit') : 10 ;
        $resturants =  ResturantResource::collection(resturant::paginate($limit));
        return $resturants->response()->setStatusCode(200,'Resturants returned successfully');
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
        $this->authorize('create',resturant::class);
        $data = request()->validate([
            'name'=>'required',
            'description'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'place_id'=> 'integer|required'

                                     ]);
        $resturant = new ResturantResource(resturant::create($data));
        return $resturant->response()->setStatusCode(200,'Resturant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id )
    {
        $resturant = new ResturantResource(resturant::findorFail($id));
        return $resturant->response()->setStatusCode(200,'Resturant returned successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(resturant $resturant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update',resturant::class);

       
       $resturant = new ResturantResource(resturant::findorFail($id));

       $resturant->update($request->all());

        return $resturant->response()->setStatusCode(200,'Resturant Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->authorize('delete',resturant::class);

        $resturant=resturant::findOrFail($id);
         $resturant->delete();    
        return response(['message' => 'resturant deleted'])->setStatusCode(200,'resturant deleted successfully');
    }

    public function index1(Request $request){
        $data = request()->validate([
            'place_id'=> 'integer|required'
]);
  $resturants =ResturantResource::collection(resturant::where('place_id',$data['place_id'])->get());
  return $resturants->response()->setStatusCode(200,'Resturants returned successfully');

                                     
              
                                     

    }
}
