<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\ProductCategory;
use App\CategoryBanner;

class CategoryBannerController extends Controller
{
    public function index()
    {
        $category_banners = CategoryBanner::all();
        $categories = ProductCategory::all();
        return view('admin.banner.category.addCategoryBanner', compact('category_banners', 'categories'));
    }
    protected function storeCategoryBanner(Request $request)
    {
        $this->validate($request, [
            'category_id' => ['required'],
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/category_banner/' . '/image/' . $filename;
            $file->move(public_path() . "/category_banner/" . "/image/", $filename);
        }
        CategoryBanner::create([
            'category_id' => $request['category_id'],
            'image' => $path,

        ]);
        toastr()->success('Category Banner Added Successfully!');
        return redirect()->back();
    }
    public function delete(CategoryBanner $banner)
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
    public function updateCategoryBanner(Request $request, CategoryBanner $banner)
    {
        $this->validate($request, [
            'category_id' => ['required'],
            'image' =>  'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/category_banner/' . '/image/' . $filename;
            $file->move(public_path() . "/category_banner/" . "/image/", $filename);
        } else {
            $path = $banner->image;
        }
        $banner->update([
            'category_id' => $request['category_id'],
            'image' => $path,

        ]);
        toastr()->success('Update Successfully!');
        return  redirect()->route('add.categroybanner');
    }
    public function edit(categoryBanner $banner)
    {
        $category_banners = CategoryBanner::all();
        $categories = ProductCategory::all();
        return view('admin.banner.category.editCategoryBanner', compact('category_banners', 'banner', 'categories'));
    }
}
