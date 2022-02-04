<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    function orderItems(){

        return $this -> hasMany(OrderItems::class);
    }

    function customer(){

        return $this -> hasMany(User::class);
    }

     function product(){

        return $this -> belongsTo(Product::class);
    }
}
