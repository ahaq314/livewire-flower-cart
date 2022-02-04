<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::where('status','=','1') -> orderBy('id','desc') -> paginate(5);
        return view('admin.product.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validate = $request -> validate([
                                        'name'  => 'required' ,
                                        'description' => 'required',
                                        'quantity' => 'required',
                                        'price' => 'required|numeric',
                                        'sales_price' => 'required|numeric',
                                        'image' => 'required|image',
                                    


       ]);

       $request->file('image')->store('public/product');
       $imageHash = $request -> image -> hashName(); 
       $slug = Str::slug($request -> name, '-');

       // thumb image

       $manager = new ImageManager();

       $image = $manager -> make('storage/product/'.$imageHash) -> resize(300,200);

       $image -> save('storage/product_thumbs/'.$imageHash);


       $product = new Product();

       $product -> name = $request -> name;
       $product -> description = $request -> description;
       $product -> quantity = $request -> quantity;
       $product -> price = $request -> price;
       $product -> sales_price = $request -> sales_price;
       $product -> image = $imageHash;
       $product -> slug = $slug;
       $product -> featured = $request -> featured;

       if ($product -> save()){
          return redirect() -> route('admin.product.index') -> with('success','Saved successfully!');
       } else {
          return back() -> with('fail','Problem occured!');
       }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
