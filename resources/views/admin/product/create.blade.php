@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
               @include('admin.sidebar')
            </div>
          
            <div class="col-sm-9 pt-5">
               @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="text-danger">{{$error}}</div>
     @endforeach
 @endif



  @if (session() -> has('fail'))
   <div class="alert alert-danger">{{ session('fail') }}</div>

 @endif
               <form method="post" 
               action="{{ route('admin.product.store') }}" 
               enctype="multipart/form-data">
               @csrf

                <input type="hidden" class="form-check-input"  name="featured" value="0">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" 
                  name="name" placeholder="Email..." value="{{ old('name') }}">
                   
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea  class="form-control" name="description" id="description" placeholder="Description...">{{ old('description') }}</textarea>
                </div>

                 <div class="form-group">
                  <label for="name">Quantity</label>
                  <input type="number" class="form-control" id="quantity" 
                  name="quantity" 
                  placeholder="Quantity..." 
                  value="{{  old('quantity') }}">
                   
                </div>

                 <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" 
                  placeholder="Price..." 
                  value="{{  old('price') }}">
                   
                </div>

                 <div class="form-group">
                  <label for="name">Sales Price</label>
                  <input type="number" class="form-control" id="sales_price" name="sales_price" placeholder="Sales price..." 
                   value="{{  old('sales_price') }}">
                   
                </div>

                 <div class="form-group">
                   <label for="exampleFormControlFile1">Image</label>
                  <input type="file" class="form-control-file" id="image" name="image">
                 </div>

                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
                  <label class="form-check-label" for="featured">Featured</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>&nbsp; <button type="reset" class="btn btn-default">Reset</button>
            </form>

            </div>
    </div>
    @endsection