<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


class PaypalPaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function handlePayment()
    {
        $data = [];
        $data['items'] = [
        ];
        foreach(Cart::getContent() as $item) {
            array_push($data['items'], [
                'name' => $item->name,
                'price' => $item->price,
                'desc' => $item->description,
                'quantity' => $item->quantity,
            ]);
        }
        
        $data['invoice_id'] = auth()->user()->id;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('success.payment');
        $data['cancel_url'] = route('cancel.payment');
        
        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']* $item['quantity'];
        }
        
        $data['total'] = $total;
        $paypalModule = new ExpressCheckout;

        $resp = $paypalModule->setExpressCheckout($data);
        $resp = $paypalModule->setExpressCheckout($data,true);
        return redirect($resp['paypal_link']);
        }
        public function paymentCancel()
        {
            return redirect()->route('cart.index')->with(['info' => 'Payment Cancelled']);
        }
        public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            foreach (Cart::getContent() as $item) {
                Order::create([
                    "user_id" => auth()->user()->id,
                    "product_name" => $item->name,
                    "product_quantity" => $item->quantity,
                    "product_price" => $item->price,
                    "total_price" => $item->price * $item->quantity,
                    "is_paid" => 1
                ]);
                Cart::clear();
            }
            return redirect()->route('cart.index')->with([
                'success' => 'Paid successfully'
            ]);
        }
    }
}//end of class