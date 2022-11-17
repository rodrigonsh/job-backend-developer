<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function view( $id )
    {
        $data = [];
        $data['product'] = Product::findOrFail($id);
        return view('view', $data);
    }

}
