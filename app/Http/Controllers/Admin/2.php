<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index() {

       
    }

    function create() {

        return view('admin.product.create');
    }
}
