<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     protected $fillable = ['name','description','quantity','featured','price','sales_price','image','slug'];


     function orders(){

        return $this -> hasMany(Order::class);
     }
}
