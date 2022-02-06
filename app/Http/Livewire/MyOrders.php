<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Auth;
use App\Notifications\OrderPlacedNotification;
use App\Models\Admin;

class MyOrders extends Component
{

    public function cancelOrder($id){

        $cancelled_order = $status = Auth::user() 
                                        -> orders() 
                                        -> find($id);

        $cancelled_order-> update(['status' => 'cancelled']);


        $admin = Admin::first();

        $admin->notify(new OrderPlacedNotification($cancelled_order));

    }

    public function render()
    {
        $myorders = Auth::user() -> orders() -> paginate(5);
        return view('livewire.my-orders',compact('myorders'));
    }
}
