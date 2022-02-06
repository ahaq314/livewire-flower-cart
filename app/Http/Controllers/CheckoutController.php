<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Gloudemans\Shoppingcart\Facades\Cart as Cart2;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
         if (Cart2::count()  == 0  )
                {

                    return redirect() -> route('user.product.list');
                }

                    return view('checkout');
    }
}
