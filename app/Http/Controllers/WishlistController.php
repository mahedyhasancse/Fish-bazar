<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Wishlist;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        Wishlist::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
        ]);
        toastr()->success('Product is added to your Favorite list.');
        return redirect()->back();
    }
    public function delete(Wishlist $wish)
    {
        $wish->delete();
        toastr()->success('Product is removed from your Favorite list.');
        return redirect()->back();
    }
}
