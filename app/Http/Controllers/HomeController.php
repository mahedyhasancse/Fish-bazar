<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;
use App\Brand;
use App\CardPayment;
use App\Delivery;
use App\Order;
use App\Recipe;
use App\ProductRecivingTime;
use App\ProductOffer;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Omnipay\Omnipay;
use App\Payment;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function contact()
    {
        return view('contactUs');
    }
    public function about()
    {
        return view('aboutUs');
    }
    public function shop()
    {
        $products = Product::latest()->paginate(100);
        return view('shop', compact('products'));
    }
    public function recipes()
    {
        $recipes = Recipe::all();
        return view('recipes', compact('recipes'));
    }
    public function recipesByCategory($recipecat)
    {
        $recipes = Recipe::where('id', $recipecat)->orWhere('parent_id', $recipecat)->get();
        return view('recipesByCategory', compact('recipes'));
    }
    public function productDetails(Product $product)
    {
        return view('productDetails', compact('product'));
    }
    public function services()
    {
        return view('services');
    }
    public function faq()
    {
        return view('faq');
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $query = $request->name;
        $products = Product::where('name', 'like', '%' . $request->name . '%')->paginate(12);
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $products->appends($request->all());
        $price['max'] = Product::max('price');
        $price['min'] = Product::min('price');
        return view('search', compact('products', 'query', 'categories', 'brands', 'price'));
    }
    public function  payment(Order $order)
    {
        return view('payment', compact('order'));
    }

    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function cashOnDelivery(Request $request, Order $order)
    {


        if ($request->payment == 'cod') {
            $order->status = "Cash on delivery";
            $order->save();
            //    ProductRecivingTime::create([
            //         'time' => $request['time'],
            //          'order_id' => $order->id,
            //          'date'=>$request['date'],
            //     ]);
            Mail::to($request->user())
                ->bcc("contact@fishbazaar.co.uk")
                ->send(new SendMail($order));
            toastr()->success('Order Process Completed');
            return redirect()->route('user.profile', $order->user->id);
        } else if ($request->payment == 'pfs') {
            $order->status = "pick from the shop";
            $order->save();
            ProductRecivingTime::create([
                'time' => $request['time'],
                'order_id' => $order->id,
                'date' => $request['date'],


            ]);
            Mail::to($request->user())
                ->bcc("contact@fishbazaar.co.uk")
                ->send(new SendMail($order));
            toastr()->success('Order Process Completed');
            return redirect()->route('user.profile', $order->user->id);
        } else if ($request->payment == 'paypal') {
            $order->status = "Payment On Paypal";
            $order->save();


            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $order->total,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }


            Mail::to($request->user())
                ->bcc("contact@fishbazaar.co.uk")
                ->send(new SendMail($order));
            return redirect()->route('user.profile', $order->user->id);
        } else if ($request->payment == 'other') {
            // foreach($order->orderDetails as $p){
            // }
            $order->status = "Payment From Card";
            $order->save();

            Mail::to($request->user())
                ->bcc("contact@fishbazaar.co.uk")
                ->send(new SendMail($order));
            // $charge = Stripe::charges()->create([
            $this->validate($request, [
                'card_no' => 'required',
                'expiry_month' => 'required',
                'expiry_year' => 'required',
                'cvv' => 'required',
            ]);

            $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $response = \Stripe\Token::create(array(
                    "card" => array(
                        "number"    => $request->input('card_no'),
                        "exp_month" => $request->input('expiry_month'),
                        "exp_year"  => $request->input('expiry_year'),
                        "cvc"       => $request->input('cvv')
                    )
                ));
                if (!isset($response['id'])) {
                    return redirect()->back();
                }
                $charge = \Stripe\Charge::create([
                    'card' => $response['id'],
                    'currency' => 'EUR',
                    'amount' =>  $order->total * 100,
                    'description' => "Fish Bazaar",
                    "metadata" => [
                        'Card on Name' => $request['name'],
                        'Shipping Name' => $order->shipped->s_name,
                        'Phone' => $order->shipped->s_phone,
                        'Address' => $order->shipped->s_address_line_1 . ' ' . $order->shipped->s_address_line_2,
                    ]
                ]);

                CardPayment::create([
                    'currency' => 'EUR',
                    'amount' =>  $order->total,
                    'order_id' => $order->id,
                    'name' => $request['name'],
                    'card_no' => $request['card_no'],
                    'expiry_month' => $request['expiry_month'],
                    'expiry_year' => $request['expiry_year'],
                    'cvv' => $request['cvv'],
                ]);

                if ($charge['status'] == 'succeeded') {
                    toastr()->success('Order Process Completed');
                    return redirect()->route('user.profile', $order->user->id);
                } else {
                    return redirect()->with('error', 'something went to wrong.');
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return redirect()->back()->with('wrong', 'Wrong Process.Please Try Again! ');
        }
    }



    public function payment_success(Request $request, Order $order)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();

                if (!$isPaymentExist) {
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->user_id=auth()->user()->id;
                    $payment->save();
                }
                toastr()->success('Payment is Successfully Done');
                return redirect()->route('user.profile',auth()->user()->id);
                // return "Payment is successful. Your transaction id is: " . $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function payment_error()
    {
        return 'User is canceled the payment.';
    }


    public function showtimeDeliveryOrder()
    {
        $orders = Order::all();
        return view('admin.Cash-On-Delivery.all', compact('orders'));
    }
    public function newProduct()
    {
        $products = Product::latest()->take(24)->paginate(8);
        return view('newProduct', compact('products'));
    }
    public function value1()
    {
        $products = Product::where('price', '1.00')->take(24)->paginate(8);
        return view('value1', compact('products'));
    }
    public function freedelivery()
    {
        return view('freeDelivery');
    }
    public function offeredProducts(ProductOffer $offer)
    {
        $offers = $offer->all();
        return view('offeredProducts', compact('offers'));
    }
    public function bookingDelivery(Request $request)
    {
        $this->validate($request, [
            'time' => 'required',
            'date' => 'required',
        ]);
        Delivery::create([
            'time' => $request['time'],
            'date' => $request['date'],
            'user_id' => auth()->user()->id,
        ]);
        toastr()->success('Continue to Shopping');
        return redirect()->route('shop');
    }
    public function mail()
    {
        return view('mail');
    }
    public function delivery(){
        $delivers=Delivery::latest()->get();
        return view('admin.all-delivery-slot',compact('delivers'));
    }
}
