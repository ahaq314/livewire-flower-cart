<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Cart2;

class Products extends Component
{
   
  
    public $term = '';

    public function render()
    {
        $term = $this->term;

        $query = Product::query();

         $query -> when($term, function($q) use ($term){

              $q -> where('name','like','%'.$term.'%');
              return $q -> orWhere('description','like','%'.$term.'%');

        });

        $products = $query -> where('status' ,'=','1') -> orderBy('name') -> paginate(8);

        return view('livewire.products',compact('products'));
    }

     public function addToCart($product_id)
    {
      
        $product = Product::findOrFail($product_id);
        Cart2::add(
            ['id' => $product->id,
             'name' => $product->name,
             'qty' =>1,
             'price' => $product->price,
             'options' => array()
         ]
        );

        $this->emit('cart_updated');
    }
}
