<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class place extends Model
{
   protected $fillable=['name'];
    use HasFactory;
    public function resturants(){
       return $this->hasMany(resturant::class);
    }
}
