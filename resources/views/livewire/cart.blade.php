<div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                <p class="heading pb-1 text-center">Cart Items</p>
                <table class="table table-striped" wire:loading.delay.class="opacity-50">
                   <thead>
                       <tr>
                          <th>Item</th>
                          <th>Price</th>
                          <th>Qty</th> 
                         
                         
                       </tr>
                   </thead>

                        <tbody>
   @php $cart = Cart::content() -> toArray() @endphp
       @foreach($cart as $row)
        
            <tr wire:key="{{ $loop->index }}">
                <td>
                    <p><strong>{{ $row['name'] }}</strong></p>
                   
                </td>
                 <td>{{  $row['price'] }}</td>
                <td>

                     <livewire:cart-update :item="$row" :key="$row['id']"/>

                </td>
               
                <td> {{ number_format($row['subtotal']) }}</td>
                 <td><a wire:click="removeFromCart('{{ $row['rowId'] }}')" onclick="confirm('Are you sure?!') || event.preventDefault();" class="text-danger"><i class="fa fa-trash"></i></a>
 <span wire:loading wire:target="removeFromCart('{{ $row['rowId'] }}')">
                                      <i class="fa fa-spin fa-spinner"></i>
                 </span>
                 </td>

                
            </tr>

          @endforeach

    </tbody>
    
    <tfoot>
      
       
        <tr>
            <td colspan="2">&nbsp;</td>
            <td>Total (Rs.)</td>
            <td>{{ Cart2::total() }}</td>
        </tr>


        <tr>
            <td><a href="{{  route('product.list') }}" class="btn btn-primary">Shop</a></td>
            @if (Cart2::count())
            <td><a href="{{  route('cart.checkout') }}" class="btn btn-success">Checkout</a></td>
            @endif
          
        </tr>
    </tfoot>
</table>
</div>
            </div>
            
        </div>
    </div>
</div>


