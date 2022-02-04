<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart2;

class CartCounter extends Component
{

 protected $listeners = ['cart_updated' => 'render'];

    public function render()
    {
        $cart_count = Cart2::content()->count();

        return view('livewire.cart-counter', compact('cart_count'));
    }
}
