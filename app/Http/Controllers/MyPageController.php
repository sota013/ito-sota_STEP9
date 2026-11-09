<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;

class MyPageController extends Controller
{
    public function index()
    {
        $products = Product::getProductsByUser(auth()->id());

        $sales = Sale::getSalesByUser(auth()->id());
    
        $user = auth()->user();
    
        return view('mypage', compact('products', 'sales', 'user'));
    }
}