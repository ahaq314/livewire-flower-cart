<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart2;

class CartUpdate extends Component
{
    public $cartItems = [];
    public $quantity = 1;

    public function mount($item)
    {
       
        $this->cartItems = $item;
       

        $this->quantity = $item['qty'];
    }

    public function updateCart()
    {
        Cart2::update($this->cartItems['rowId'],  $this->quantity);


         $this->emit('cart_updated');
         $this->emit('cart_render');
    }

    public function incrQty($qty){

            $this->quantity = $qty + 1;
            $this -> refresh();
    }

     public function decrQty($qty){

            $this->quantity = $qty - 1;
            $this -> refresh();
    }

    public function render()
    {
        return view('livewire.cart-update');
    }

    public function refresh(){

         $this -> updateCart();
         $this->emit('cart_render');
    }
}
