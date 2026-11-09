<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store($id)
    {
        Like::toggleLike(auth()->id(), $id);
    
        return redirect()->route('products.show', $id);
    }
}
