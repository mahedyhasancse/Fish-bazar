<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\ProductCategory;
use App\BrandBanner;
use App\Recipe;
use App\Brand;
use App\Bus;
use App\Car;
use App\CategoryBanner;
use App\Delivery;
use App\Order;
use App\ProductOffer;
use App\Wishlist;
use App\Instagram;
use App\Payment;
use App\Train;
use App\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Cart;
use App\PostCode;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function welcome(Product $product)
    {
        $deliveries = Delivery::latest()->take(1)->get();
        $cars = Car::all();
        $buses = Bus::all();
        $trains = Train::all();
        $videos = Video::all();
        $instagrams = Instagram::all();
        $recipes = Recipe::latest()->take(4)->get();
        $products = Product::all();
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $brandbanners = BrandBanner::all();
        $categoryBanners = CategoryBanner::all();
        $price['max'] = Product::max('price');
        $price['min'] = Product::min('price');
        $offers = ProductOffer::latest()->get();
        return view('welcome', compact('products', 'product', 'categories', 'brandbanners', 'brands', 'price', 'offers', 'recipes', 'instagrams', 'videos', 'buses', 'trains', 'cars', 'deliveries'));
    }
    public function adminIndex()
    {
        $orders = Order::all();
        return view('admin.index', compact('orders'));
    }

    public function adminProfile(User $user)
    {
        return view('admin.profile.profile', compact('user'));
    }
    public function userProfile(User $user)
    {
        return view('user.profile', compact('user'));
    }
    public function editAdmin(User $user)
    {
        return view('admin.profile.updateProfile', compact('user'));
    }
    protected function updateAdmin(Request $request, User $user)
    {

        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['string', 'max:255', 'nullable'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'street' => ['required', 'max:255'],
        ]);
        $user->update([
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'street' => $request['street'],
            'post_code' => $request['post_code'],
        ]);
        if ($request->password != null) {
            $user->password = Hash::make($request['password']);
            $user->save();
        }
        toastr()->success('Admin Updated successfully!');
        return redirect()->route('admin.profile', $user->id);
    }
    public function editUser(User $user)
    {
        return view('user.editUser', compact('user'));
    }
    public function updateUser(Request $request, User $user)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['string', 'max:255', 'nullable'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'street' => ['required', 'max:255'],


        ]);
        $user->update([
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'street' => $request['street'],
            'post_code' => $request['post_code'],

        ]);
        if ($request->password != null) {
            $user->password = Hash::make($request['password']);
            $user->save();
        }
        toastr()->success('Updated successfully!');
        return redirect()->route('user.profile', $user->id);
    }
    public function allUser()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.allUser', compact('users'));
    }
    public function allAdmin()
    {
        $users = User::where('is_admin', true)->get();
        return view('admin.allAdmin', compact('users'));
    }
    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->save();
        toastr()->success('Updated successfully!');
        return redirect()->route('user.all');
    }
    public function makeUser(User $user)
    {
        $user->is_admin = false;
        $user->save();
        toastr()->success('Updated successfully!');
        return redirect()->route('admin.all');
    }
    public function wishlist(Wishlist $wish)
    {
        $wishes = $wish->where('user_id', auth()->user()->id)->latest()->get();
        return view('wishlist', compact('wishes'));
    }
    public function search(Request $request, Product $product)
    {
        $products = Product::all();
        $product = $product->latest(10);
        return redirect()->back()->with('home');
    }
    public function productSearchRange(Request $request)
    {
        $price['max'] = Product::max('price');
        $price['min'] = Product::min('price');
        $searchPrice = explode(",", $request->price);
        if ($request->name != null) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')->whereBetween(
                'price',
                [intval($searchPrice[0]), intval($searchPrice[1])]
            )->paginate(12);
            $query = $request->name;
        } else {
            $products = Product::whereBetween('price', [intval($searchPrice[0]), intval($searchPrice[1])])->paginate(12);
            $query = null;
        }
        $categories = ProductCategory::join('products', 'category_id', 'product_categories.id')
            ->select('product_categories.id', 'product_categories.name', 'product_categories.slug', DB::raw('count("product_categories.id") as countCategory'))
            ->groupBy('product_categories.id', 'product_categories.name', 'product_categories.slug')
            ->orderBy('countCategory', 'desc')
            ->take(5)
            ->get();
        $products->appends($request->all());
        return view('search', compact('products', 'query', 'categories', 'searchPrice', 'price'));
    }
    public function userCheckout($lat, $lon)
    {
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
        if ($lat != 'ha' || $lon != 'ha') {
            $query = $lat . ',' . $lon;
            $geocoder = new \OpenCage\Geocoder\Geocoder('83d88a1f9eac460bb380ab54bb477a28');
            $result = $geocoder->geocode($query); # latitude,longitude (y,x)
            $location = $result['results'][0]['formatted'];
        } else {
            $location = '';
        }
        return view('checkout', compact('products', 'cart', 'location'));
    }
    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
    public function delivery()
    {
        $deliveries = Delivery::latest()->take(1)->get();
        $orders = Order::all();
        return view('boking', compact('orders', 'deliveries'));
    }
    public function checkPostcode($chkcode, Request $request, PostCode $postcode)
    {
        $subcode = explode(" ", $chkcode);
        $status = $postcode->where('post_code', 'like', '%' . $subcode[0] . '%')->get();
        if ($status->count() > 0) {
            $request->session()->push('postcode', $chkcode);
            return 1;
        } else {
            return 2;
        }
    }
    public function removePostcode(Request $request)
    {
        $request->session()->forget('postcode');
        return 0;
    }
    public function paypalPayment()
    {
        $payments = Payment::all();
        return view('admin.paypalPayment', compact('payments'));
    }
    public function deletePaypalpayment(Payment $payment)
    {
        $payment->delete();
        toastr()->success('Delete successfully!');
        return redirect()->back();
    }
}
