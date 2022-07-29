<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function brand()
    {
        $brands = Brand::all();
        return view('admin.brand.addBrand', compact('brands'));
    }
    protected function StoreBand(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'required',
            'image' =>  'required'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/brand/' . '/image/' . $filename;
            $file->move(public_path() . "/brand/" . "/image/", $filename);
        }
        $brand = Brand::create([
            'name' => $request['brand_name'],
            'image' => $path,

        ]);
        toastr()->success('Brand Added Successfully!');
        return redirect()->back();
    }
    public function delete(Brand $brand)
    {

        $image_path = public_path() . $brand->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $brand->delete();
        toastr()->success('Band Delete Successfully!');
        return redirect()->back();
    }
    public function brandwiseProduct(Brand $brand)
    {
        $products = $brand->product;
        return view('brandwiseProduct', compact('brand', 'products'));
    }
}
