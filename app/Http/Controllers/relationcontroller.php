<?php

namespace App\Http\Controllers;

use App\Models\place;
use App\Models\resturant;
use Illuminate\Http\Request;

class relationcontroller extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:api');     
    
    }


    public function PlaceResturants($id){
        $resturants= place::findorFail($id)->resturants;
        $fields=[];
        $filtered=[];
        foreach($resturants as $resturant){
            $fields['Name']=$resturant->name;
            $fields['Description Of Resturant']=$resturant->descriotion ;
            $fields['Address']=$resturant->address;
            $fields['email']=$resturant->email;
            $filtered[]=$fields;
        }
       return response(['The resturants of this place ' => $filtered])->setStatusCode(200 , 'success!');
    }


    
    public function ResturantsPlace($id){
        $place= resturant::findorFail($id)->place;
        $fields=[];
        $filtered=[];
      
            $fields['Name']=$place->name;
            
            $filtered[]=$fields;
        
       return response(['The Place of this resturant ' => $filtered])->setStatusCode(200 , 'success!');
    }

}