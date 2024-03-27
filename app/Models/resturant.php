<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resturant extends Model
{
    protected $fillable=[
        'name',
        'description',
       'address',
     'email',
     'opening_hours',
     'phone',
    'place_id'];
    use HasFactory;
    public function place(){
        return $this->belongsTo(place::class);
    }

    public function reservations(){

        return  $this->hasMany(reservation::class);
      }
}
