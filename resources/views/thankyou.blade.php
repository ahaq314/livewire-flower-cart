@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
      <div class="col-md-6 mx-auto mt-5">
         <div class="payment">
            <div class="payment_header">
               <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
            </div>
            <div class="content">
               <h1>Order Placed !</h1>
               <p>You order has been placed. </p>
               <a href="#">My Orders</a> <a href="{{  route('product.list') }}">Shop Again</a>
            </div>
            
         </div>
      </div>
   </div>
</div>

   
@endsection
