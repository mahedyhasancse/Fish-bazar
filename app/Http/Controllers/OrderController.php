<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderDetails;
use App\Product;
use App\Shipping;
use App\Order;
use App\Payment;
use App\ProductRecivingTime;
use App\Rating;
use Illuminate\Database\Eloquent\Collection;
use Cart;
use Session;
use App\PostCode;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        // $subcode = explode(" ",$request->post_code);
        // $codestatus = PostCode::where('post_code', 'like', '%'.$subcode[0].'%')->get();
        // if ($codestatus->count() > 0) {
        //     return redirect()->back()->with('postcodeerror', 'Sorry, we do not deliver to '.Str::upper($request->post_code).' at the moment.');
        // }
        $user = auth()->user();
        if (isset($request->others)) {
            $this->validate($request, [
                's_name' => ['required'],
                's_address_line_1' => ['required'],
                's_phone' => ['required'],
            ]);
        } else {
            $this->validate($request, [
                'address_line_1' => ['required'],
            ]);
        }
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->subTotal = $item->getPriceSum();
            $product->color = $item->attributes['color'];
            $product->size = $item->attributes['size'];
            $products->push($product);
        }
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cart['subTotal'],
            'order_no' => 'order-' . time(),
            'paid' => $cart['subTotal'],
            'note' => $request->note ?? null,
            'status' => 'Pending',
        ]);



        foreach ($products as $product) {
            OrderDetails::create([
                'admin_id' => $product->admin_id,
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product->quantity,
                'color' => $product->color,
                'size' => $product->size,

            ]);
        }
        if (isset($request->others)) {
            Shipping::create([
                'order_id' => $order->id,
                'post_code' => $request['post_code'],
                's_name' => $request->s_name,
                's_phone' => $request->s_phone,
                's_address_line_1' => $request->s_address_line_1,
                's_address_line_2' => $request->s_address_line_2,
                'status' => 'Order Placed'

            ]);
        } else {
            Shipping::create([
                'order_id' => $order->id,
                'post_code' => $request['post_code'],
                's_name' => $user->username,
                's_phone' => $user->phone,
                's_address_line_1' => $request->address_line_1,
                's_address_line_2' => $request->address_line_2,
                'status' => 'Order Placed',
            ]);
        }
        Cart::clear();
        toastr()->success('Order Placed Successfully');
        return redirect()->route('show.payemnt.method', $order->id);
    }

    public function UsercancelOrder(Order $order)
    {
        $order->status = "Payment Cancel";
        $order->save();
        foreach ($order->orderDetails as $od) {
            $od->status = 'Order Cancel';
            $od->save();
        }
        // Session::flash('success', 'Delete Successfully');
        toastr()->success('Order Cancel Successfully!');
        return redirect()->back();
    }
    public function adminCancelOrder(Order $order)
    {
        $order->status = "Payment Cancel";
        $order->save();
        foreach ($order->orderDetails as $od) {
            $od->status = "Order Cancel";
            $od->save();
        }
        toastr()->success('Order Canceled!');
        return redirect()->back();
    }
    public function paypalconfirmOrder(Order $order)
    {
        $order->status = "Order Process:full |Payment On PayPal";
        $order->save();
        foreach ($order->orderDetails as $od) {
            $od->status = "Order Confirmed";
            $od->save();
        }
        
        toastr()->success('Order Updated Successfully');
        return redirect()->back();
    }
    public function details(Order $order)
    {
        if (auth()->user()->id == $order->user->id || auth()->user()->is_admin) {
         
            return view('viewDetails', compact('order'));
        }
    }
    public function deleteDelivertime(ProductRecivingTime $time)
    {
        $time->delete();
        toastr()->success('Delete Successfully');
        return redirect()->back();
    }

    public function cashondeliveryconfirmOrder(Order $order)
    {
        $order->status = "Order Process:full |take Cash on Delivery";
        $order->save();
        foreach ($order->orderDetails as $od) {
            $od->status = "Order Confirmed";
            $od->save();
        }
        toastr()->success('Order Updated Successfully');
        return redirect()->back();
    }
    public function productshipped(Order $order)
    {
        foreach ($order->orderDetails as $od) {
            $od->status = "Order shift";
            $od->save();
        }
        toastr()->success('Order Updated Successfully');
        return redirect()->back();
    }
    public function orderRating(Request $request, Order $order)
    {
        $this->validate($request, [
            'rating' => ['required', 'min:0', 'max:5'],
            'feedback' => ['required', 'min:5', 'max:1000'],
        ]);
        foreach ($order->orderDetails as $od) {
            $od->status = "Completed";
            $od->save();
        }
        Rating::create([
            'rating' => $request->rating,
            'order_details_id' => $od->id,
            'feedback' => $request->feedback,
        ]);
        toastr()->success('Feedback Provided!');
        return redirect()->back();
    }
    public function deleteOrder(Order $order)
    {
        $order->delete();
        toastr()->success('Delete Successfully');
        return redirect()->back();
    }
}
