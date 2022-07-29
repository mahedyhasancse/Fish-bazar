<?php

namespace App\Http\Controllers;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Product;

class BannerController extends Controller
{
    public function addBanner(){
        $banners=Banner::all();
       return view('admin.banner.addBanner',compact('banners'));
    }
    protected function storeBanner(Request $request)
    {
        $this->validate($request, [
                'image' =>  'required'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/Banner/' .'/image/' . $filename;
            $file->move(public_path() . "/Banner/" ."/image/", $filename);
        }
        $banner = Banner::create([
            'image' => $path,
        ]);
        toastr()->success('Banner add successfully!');
        return redirect()->route('banner.add');
    }
    public function delete(Banner $banner){
         $banner->delete();
         $image_path = public_path().$banner->image;
         //dd($image_path);
         if (File::exists($image_path)) {
             File::delete($image_path);
             //unlink($image_path);
         }
         toastr()->success('Bannner Delete Successfully!!');
         return redirect()->route('banner.add');
    }
}
