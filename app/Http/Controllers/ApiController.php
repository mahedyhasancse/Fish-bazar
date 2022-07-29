<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\PostCode;

class ApiController extends Controller
{

    public function singleProductApi($prod,Product $product)
    {
        $productDetails = $product->find($prod);
        // $details = $product->productDetails;
        // $sizes = explode(',', $product->productDetails->size);
        // $colors = explode(',', $product->productDetails->color);
        $image = $productDetails->image[0]->image;
        $result = [$productDetails, $image];
        return $result;
    }
    public function productmodal(Product $product)
    {
        return view('test', compact('product'));
    }
    
    public function postcodeInit(Request $request, PostCode $postcode)
    {
        if (auth()->user() && auth()->user()->post_code) {
            $data = [
                'status' => 1,
                'postcode' => auth()->user()->post_code,
            ];
        // }elseif ($request->session()->get('postcode')) {
        //     $data = [
        //         'status' => 1,
        //         'postcode' => '',
        //     ];
        }else {
            $data = [
                'status' => 0,
                'postcode' => '',
            ];
        }
        return $data;
    }

    public function postcodeCheck($chkcode,Request $request, PostCode $postcode)
    {
        $subcode = explode(" ",$chkcode);
        $status = $postcode->where('post_code', 'like', '%'.$subcode[0].'%')->get();
        if($status->count() > 0){
            // $request->session()->push('postcode', $chkcode);
            return 1;
        }else{
            return 2;
        }
    }
}
