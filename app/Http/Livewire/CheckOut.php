<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Order;
use Cart2;
use OrderItem;

class CheckOut extends Component
{

    public $firstname;
    public $lastname;
    public $address;
    public $mobile;

    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'mobile' => 'required|numeric',
    ];

    public function render()
    {
        return view('livewire.check-out');
    }

     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveOrder() {

        $validatedData = $this->validate();


      $status = \DB::transaction(function(){

         $order = new Order;

        $order->user_id = Auth()->id();
        $latestOrder = Order::orderBy('created_at','DESC')->first();

        $lastOrder = is_null($latestOrder) ? '0' :$latestOrder -> id;

        $order -> order_number = str_pad($lastOrder + 1, 8, "0", STR_PAD_LEFT);
        $order -> grand_total = intval(preg_replace('/[^\d.]/', '', Cart2::total()));
        $order -> item_count = Cart2::count();
        $order -> first_name = $this -> firstname;
        $order -> last_name = $this -> lastname;
        $order -> address = $this -> address;
        $order -> phone_number = $this -> mobile;
        $order -> user_id = Auth()->id();

        $s1 = false;

        if ($order->save()){
           
            $s1 = true;
        }

        $order_items = array();
        foreach (Cart2::content()  as $item){

            $order_items[] = array('order_id' => $order -> id,
                                   'product_id' => $item -> id,
                                   'quantity' => $item -> qty,
                                   'price' => $item -> price
                                  );


        }  

        $s2 = false;

        if (\DB::table('order_items') -> insert($order_items)){
          
            $s2 = true;
        }

       

        if ($s1 === true && $s2 === true){

           return true;

        } else {
            
            return false;
        }


      });
     
      if ($status === true){
        Cart2::destroy();
        return redirect() -> route('thankyou');
      }
      else {
         return redirect() -> route('product.list') -> with('failed','Problem occured! Try again.');
      }
    }
        
}
