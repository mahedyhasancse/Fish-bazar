<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\BrandBanner;
use App\Brand;
use App\Product;

class BrandBannerController extends Controller
{
    public function index()
    {
        $brand_banners = BrandBanner::all();
        $brands = Brand::all();
        return view('admin.banner.brand.addBrandBanner', compact('brands', 'brand_banners'));
    }
    protected function brandBranner(Request $request)
    {
        $this->validate($request,[
            'brand_id' => 'required',
            'image' =>  'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/brand_banner/' . '/image/' . $filename;
            $file->move(public_path() . "/brand_banner/" . "/image/", $filename);
        }
        BrandBanner::create([
            'brand_id' => $request['brand_id'],
            'image' => $path,

        ]);
        toastr()->success('Banner Add Successfully');

        return redirect()->back();
    }
    public function delete(BrandBanner $banner)
    {
        $image_path = public_path() . $banner->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $banner->delete();
        toastr()->success('Delete Successfully!');
        return redirect()->back();
    }
    public function edit(BrandBanner $banner)
    {
        $brands = Brand::all();
        return view('admin.banner.brand.editBrandBanner', compact('banner', 'brands'));
    }
    public function updateBrandBanner(Request $request, BrandBanner $banner)
    {
        $this->validate($request,[
            'brand_id' => 'required',
            'image' =>  'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/brand_banner/' . '/image/' . $filename;
            $file->move(public_path() . "/brand_banner/" . "/image/", $filename);
        } else {
            $path = $banner->image;
        }
        $banner->update([
            'brand_id' => $request['brand_id'],
            'image' => $path,
        ]);
        toastr()->success('Update Successfully!');
        return redirect()->route('add.brandbanner');
    }
}
