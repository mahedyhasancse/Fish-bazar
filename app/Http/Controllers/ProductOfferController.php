<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\ProductOffer;

class ProductOfferController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $offers = ProductOffer::all();
        return view('admin.offers.list', compact('products', 'offers'));
    }
    public function store(Request $request, ProductOffer $offer)
   {
       $this->validate($request,[
           'offerPrice' => ['required'],
           'validTill' => ['required','date'],
           'product_id' => ['required'],
       ]);
        $checkoffer = $offer->where('product_id', $request->product_id)->first();
        if ($checkoffer) {
            $checkoffer->update([
                'offerPrice' => $request->offerPrice,
               'validTill' => $request->validTill,
            ]);
        }else {
            ProductOffer::create([
                'offerPrice' => $request->offerPrice,
                'validTill' => $request->validTill,
                'product_id' => $request->product_id,
                ]);
       }
       toastr()->success('Product Offer Added Successfully');
       return redirect()->route('product.offers');
   }
   public function edit(ProductOffer $offer)
   {
        $products = Product::all();
        $offers = ProductOffer::all();
        return view('admin.offers.editoffer', compact('offer', 'offers', 'products'));
   }
}
