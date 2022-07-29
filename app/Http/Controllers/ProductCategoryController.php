<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\File;
class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.category.addCategory', compact('categories'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:product_categories'],
            'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/categroy/' . '/image/' . $filename;
            $file->move(public_path() . "/categroy/" . "/image/", $filename);
        } else {
            $path = NULL;
        }
        if ($request->parent_id == '') {
            $category = ProductCategory::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $path,
            ]);
        } else {
            $category = ProductCategory::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $path,
                'parent_id' => $request->parent_id,
            ]);
        }
        toastr()->success('Category Added Successfully!');
        return redirect()->route('category.index');
    }
    public function edit(ProductCategory $category)
    {
        $categories = ProductCategory::all();
        return view('admin.category.updateCategory', compact('category', 'categories'));
    }
    public function delete(ProductCategory $category)
    {
        $image_path = public_path() . $category->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $category->delete();
        toastr()->success('Category Deleted successfully!');
        return redirect()->route('category.index');
    }
    public function update(Request $request, ProductCategory $category)
    {

        if ($category->slug == $request->slug) {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
            ]);
        } else {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', 'unique:product_categories'],
            ]);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/category/' . '/image/' . $filename;
            $file->move(public_path() . "/category/" . "/image/", $filename);
        } else {
            $path = $category->image;
        }
        if ($request->parent_id == '') {
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $path,
            ]);
        } else {
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $path,
                'parent_id' => $request->parent_id,
            ]);
        }
        toastr()->success('Category Updated Successfully!');
        return redirect()->route('category.index');
    }
    public function categoywiseProduct(ProductCategory $category)
    {
        $products = $category->product;
        return view('categorywiseProduct', compact('category', 'products'));
    }
}
