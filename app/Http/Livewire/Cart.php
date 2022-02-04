<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart2;


class Cart extends Component
{
    public $cart;
    protected $listeners = ['cart_render' => 'render'];

   

    public function render()
    {

        return view('livewire.cart');
    }

    public function removeFromCart($productId)
    {
      sleep(4);
        cart2::remove($productId);
        $this->emit('cart_render');
        $this->emit('cart_updated');
    }

    public function checkout(): void
    {
        CartFacade::clear();
        $this->emit('clearCart');
        $this->cart = CartFacade::get();
    }
}
