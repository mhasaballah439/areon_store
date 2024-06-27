<?php namespace Coolnet\Orders\Components;

use Cms\Classes\ComponentBase;
use Auth;
use Input;
use Stripe;
use Event;
use Session;
use Mail;
use Coolnet\Cart\Classes\CoolNetCart;
use Coolnet\Cart\Models\CartData;
use Coolnet\Orders\Models\Orders;
use Coolnet\Orders\Models\OrdersDetails;
use Coolnet\Websetting\Models\WebSetting;

class Checkout extends ComponentBase
{

    public function componentDetails()
    {

        return [
            'name' => 'Checkout Data',
            'description' => 'Return all Checkout Data'
        ];

    }


    public function onCheckout(){
        $params = Input::all();

        $cart = new CoolNetCart();
        $cartData = CartData::where('user_id',Auth::getUser()->id)->first();
        $payment = isset($params['payment']) ? $params['payment'] : Session::pull('order_payment');
        $note = isset($params['note']) ? $params['note'] : Session::pull('order_note');
        if ($cartData){
            $order = new Orders;
            $order->code = $this->genrateOrderCode();
            $order->user_id = Auth::getUser()->id;
            $order->address_id = $cartData->address_id;
            $order->delivery = $cartData->delivery_method;
            $order->status_id = 1;
            $order->is_payment = 0;
            $order->payment = $payment;
            $order->note = $note;
            $order->order_from = 'web';
            $order->save();

            foreach ($cartData->itemsList as $detail){
                $orderDetail = new OrdersDetails;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_name = $detail->options['title'];
                $orderDetail->qty = $detail->quantity;
                $orderDetail->price = $detail->price;
                $orderDetail->product_id = $detail->product_id;
                $orderDetail->save();
            }
            $cart->clear();
        }
        if (isset($params['result']['paymentIntent']['id']))
            $this->createPaymentStrip($order, $params['result']['paymentIntent']['id']);

        $setting = WebSetting::first();
        Mail::send('newOrder', ['order' => $order,'setting' => $setting], function ($message) {

            $message->to(Auth::getUser()->email, 'areon.no')->cc('post@areon.no');
            $message->subject('New order from areno.no');

        });
        return $order;
    }

    protected function getCode($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0) $result .= mt_rand(1, 9);
            else $result .= mt_rand(0, 9);
        }
        return $result;
    }

    protected function genrateOrderCode()
    {
        do {
            $code = $this->getCode(6);
            $data = Orders::where('code', $code)->first();
            if (!$data) return $code;
        } while (true);
    }

    public function onPaymentStripe()
    {
        $cart = new CoolNetCart();
        $params = Input::all();

        Session::put('order_note', $params['note']);
        Session::put('order_payment', $params['payment']);

        $total = $cart->total_round();

        if ($params['payment'] == "cash")
            return $this->onCheckOut();

        if ($total == 0)
            return Null;

        $setting = WebSetting::first();
//        dd($setting);
        if ($setting->active_test) {
            $pk = $setting->pk_test;
            $sk = $setting->sk_test;
        } else {
            $pk = $setting->pk_live;
            $sk = $setting->sk_live;
        }
            Stripe\Stripe::setApiKey($sk);
        $intent = Stripe\PaymentIntent::create([
            'amount' => $total * 100,
            'currency' => $setting->currency,
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);

        return [
            'intent' => $intent,
            'pk' => $pk,
        ];
    }

    public function createPaymentStrip($order, $trans_id)
    {
        $setting = WebSetting::first();
        $resp = NULL;
        if ($setting->active_test) {
            $pk = $setting->pk_test;
            $sk = $setting->sk_test;
        } else {
            $pk = $setting->pk_live;
            $sk = $setting->sk_live;
        }
        $stripe = new Stripe\StripeClient($sk);

        $resp = $stripe->paymentIntents->retrieve($trans_id);

        if (isset($resp['status']) && $resp['status'] == "succeeded") {
            $order->is_payment = 1;
            $order->payment_info = $resp;
            $order->save();

            return true;
        }
        return false;
    }
}

