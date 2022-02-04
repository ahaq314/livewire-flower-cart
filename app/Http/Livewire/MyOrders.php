<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Auth;

class MyOrders extends Component
{

    public function cancelOrder($id){

        $status = Auth::user() -> orders() -> find($id) -> update(['status' => 'cancelled']);

    }

    public function render()
    {
        $myorders = Auth::user() -> orders() -> paginate(5);
        return view('livewire.my-orders',compact('myorders'));
    }
}
