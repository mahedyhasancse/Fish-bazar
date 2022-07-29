<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use App\ProductCategory;
use App\ProductDetails;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Cart;

class ProductController extends Controller
{
    public function addProduct()
    {
        $brands = Brand::all();
        $categories = ProductCategory::all();
        return view('admin.product.addProduct', compact('categories', 'brands'));
    }
    protected function storeProduct(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'name' => ['required', 'string',],
            'company_name' => ['required', 'string'],
            'category_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['string'],
            'filename' => ['required'],
            'model' => ['string', 'max:255',],
            'brand' => ['string', 'max:255'],
        ]);
        $product = Product::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'category_id' => $request['category_id'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'description' => $request['description'],
            'brand_id' => $request->brand,
            'admin_id' => $user->id,

        ]);
        $productDetails = ProductDetails::create([
            'color' => $request['color'],
            'size' => $request['size'],
            'model' => $request['model'],
            'product_id' => $product->id,

        ]);
        if ($request->hasFile('filename')) {
            $i = 0;
            foreach ($request->file('filename') as $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = time() + $i . '.' . $extention;
                $path = "/admin/" . "/product/" . $filename;
                $file->move(public_path() . "/admin/" . "/product/", $filename);

                Image::create([
                    'image' => $path,
                    'product_id' => $product->id,

                ]);
                $i++;
            }
        }
        toastr()->success('Product add successfully!');
        return redirect()->route('product.all');
    }

    public function allProduct()
    {
        $products = Product::all();
        return view('admin.product.allProducts', compact('products'));
    }
    public function delete(Product $product)
    {
        foreach ($product->image as $image) {

            $image_path = public_path() . $image->image;
            //dd($image_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
                //unlink($image_path);
            }
        }
        $product->delete();
        toastr()->success('Product Delete Successfully!');
        return redirect()->route('product.all');
    }
    public function editProduct(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.product.editProduct', compact('categories', 'product'));
    }
    public function updateProduct(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => ['required', 'string',],
            'company_name' => ['required', 'string'],
            'category_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['string'],
            'model' => ['string', 'max:255',],
        ]);

        $product->update([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'category_id' => $request['category_id'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'description' => $request['description'],

        ]);
        $product->productDetails->update([
            'color' => $request['color'],
            'size' => $request['size'],
            'model' => $request['model'],
            'product_id' => $product->id,

        ]);

        if ($request->hasFile('image')) {
            $i = 0;
            foreach ($request->file('image') as $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = time() + $i . '.' . $extention;
                $path = "/admin/" . "/product/" . $filename;
                $file->move(public_path() . "/admin/" . "/product/", $filename);
                Image::create([
                    'image' => $path,
                    'product_id' => $product->id,

                ]);
                $i++;
            }
        }
        toastr()->success('Product Update successfully!');
        return redirect()->route('product.all');
    }
    public function singleImageDelete(Image $image)
    {
        $image_path = public_path() . $image->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $image->delete();
        toastr()->success('Image Deleted Successfully');
        return redirect()->back();
    }

    public function addCart(Request $request, Product $product)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);

        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'size' => ($request->size != null) ? $request->size : null,
                'color' => ($request->size != null) ? $request->color : null,
            )
        ));
        toastr()->success('Add To Cart Successfully');
        return redirect()->back();
    }
    public function ajaxaddCart(Request $request, Product $product)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);

        Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'size' => ($request->size != null) ? $request->size : null,
                'color' => ($request->size != null) ? $request->color : null,
            )
        ));
    }
    public function ajaxupdateCart(Request $request, Product $product)
    {
        if ($request['quantity'] < 1) {
            Cart::remove($product->id);
            $cart = '';
            $image = '';
            $model = '';
        } else {
            $chk = Cart::get($product->id);
            if (empty($chk)) {
                if ($product->offer) {
                    $price = $product->offer->offerPrice;
                } else {
                    $price = $product->price;
                }
                Cart::add(
                    array(
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $price,
                        'quantity' => $request->quantity,
                        'attributes' => array(
                            'size' => ($request->size != null) ? $request->size : null,
                            'color' => ($request->size != null) ? $request->color : null,
                        )
                    )
                );
            } else {
                Cart::update($product->id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->quantity,
                    ),
                ));
            }
            $cart = Cart::get($product->id);
            $image = Product::find($product->id)->image[0]->image;
            $image = asset($image);
            $model = Product::find($product->id)->productDetails->model;
        }
        $carts = Cart::getContent();
        $res = [
            'product' => $cart,
            'subtotalprice'  => Cart::getTotal(),
            'totalprice'     => Cart::getTotal(),
            'items'          => $carts->count(),
            'image'          => $image,
            'model'          => $model,
        ];
        return $res;
    }
    public function removeCart(Request $request, Product $product)
    {
        Cart::remove($product->id);
        return redirect()->back()->with('status', 'Cart Remove Successfully!');
    }
    public function cartshow()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $cart['count'] = Cart::getContent()->count();
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->subTotal = $item->getPriceSum();
            $products->push($product);
        }
        return view('cart', compact('products', 'cart', 'categories', 'brands'));
    }
    public function updateCart(Request $request, Product $product)
    {
        if ($request['quantity'] == 0) {
            Cart::remove($product->id);
            return redirect()->back()->with('status', 'Cart Remove Successfully!');
        } else {
            Cart::update($product->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity,
                ),
            ));
            toastr()->success('Update successfully!');
            return redirect()->back();
        }
    }
    public function is_top(Product $product)
    {
        $product->is_top_selling = true;
        $product->save();
        toastr()->success('Update successfully!');
        return redirect()->back();
    }
    public function is_not_top(Product $product)
    {
        $product->is_top_selling = false;
        $product->save();
        toastr()->success('Update successfully!');
        return redirect()->back();
    }
    public function most_view(Product $product)
    {
        $product->is_most_view = true;
        $product->save();
        toastr()->success('Update successfully!');
        return redirect()->back();
    }
    public function most_view_remove(Product $product)
    {
        $product->is_most_view = false;
        $product->save();
        toastr()->success('Update successfully!');
        return redirect()->back();
    }
    public function is_hide(Product $product)
    {
        $product->is_hide = true;
        $product->save();
        toastr()->success('Update successfully!');
        return redirect()->back();
    }
    public function remove_hide(Product $product)
    {
        $product->is_hide = false;
        $product->save();
        toastr()->success('Update successfully!');
        return redirect()->back();
    }
}
