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

 @if (session() -> has('success'))
   <div class="alert alert-success">{{ session('success') }}</div>

 @endif
           
         @if ($products->count())
            <table class="table table-striped">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Sales Price</th>
                    <th>Qty</th>
                    <th>Action</th>
                  
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>
                                @if (!empty($item->image))
                                    <img width="60" src="{{ url('storage/product_thumbs/'. $item->image) }}" />
                                @else
                                    No image!
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                             <td>{{ $item->price }}</td>
                             <td>{{ $item->sales_price }}</td>
                             <td>{{ $item->quantity }}</td>
                            <td>
                               <a href="">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $products->links()}}
        @endif
            </div>
    </div>
    @endsection