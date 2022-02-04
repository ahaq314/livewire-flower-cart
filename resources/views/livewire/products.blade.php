<div>
    <div class="container justify-content-center mt-50 mb-50">
            <div class="row">
                <div class="col-sm-12">
<div class="card">
     
    @if ($products -> count())
                
        <div class="search-area">
            <input type="text" name="term" wire:model.debounce.500ms="term" class="form-control" id="search" placeholder="Search" />
           <span wire:loading wire:target="term">
                                      <i class="fa fa-spin fa-spinner"></i>
                 </span>
        </div>
       

      <div class="products products-table" wire:loading.delay.class="opacity-50">
         @foreach ($products as $item)


  
        <div class="product" wire:key="{{ $loop->index }}">
            <div class="product-img">
                <img width="100" src="{{ url('storage/product_thumbs/'. $item->image) }}" />
            </div>
            <div class="product-content">
                <h3>
                    {{ $item -> name }}
                  
                </h3>
                <p class="product-text price">Rs. {{ $item -> price }}</p>
               <button wire:click="addToCart({{ $item -> id }})">Add Cart</button>
            </div>
        </div>
    
             
          @endforeach
          </div>
           {{ $products->links() }}
    </div>
        @endif
    </div>
</div>
</div>
</div>
</div>
