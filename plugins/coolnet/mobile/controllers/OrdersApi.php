<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Cart\Classes\CoolNetCart;
use Coolnet\Cart\Models\CartData;
use Coolnet\Orders\Models\Orders;
use Coolnet\Orders\Models\OrdersDetails;
use Coolnet\Products\Models\ProductsMovement;
use Illuminate\Http\Response;
use Coolnet\Websetting\Models\WebSetting;
use Illuminate\Support\Facades\Request;
use JWTAuth;
use Input;
use Stripe;
use Event;
use Mail;

class OrdersApi extends Controller
{
    var $user;

    public function __construct($theme = null)
    {
        parent::__construct($theme);
        $this->user = $this->getAuthenticatedUser();
    }


    public function createOrder()
    {
        $orderData = [];
        $cart = new CoolNetCart();
        $params = Input::all();
        if ($this->user):
            $cartData = CartData::where('user_id',$this->user->id)->first();
        if ($cartData->itemsList != null && $cart->total_round() > 0) {
            if (isset($params['trans_id']))
                $trans = $this->paymentNow($params['trans_id']);
            else
                return response()->json(['msg' => 'Error in card']);

            $order = new Orders;
            $order->code = $this->genrateOrderCode();
            $order->user_id = $this->user->id;
            $order->address_id = $cartData->address_id != null ? $cartData->address_id : 0;
            $order->delivery = $cartData->delivery_method != null ? $cartData->delivery_method : null;
            $order->status_id = 1;
            $order->is_payment = (isset($trans) && $trans) ? 1 : 0;
            $order->note = $params['note'];
            $order->payment = $params['payment'];
            $order->order_from = "App";
            $order->payment_info = (isset($trans)) ? $trans : [];
            $order->save();

            foreach ($cartData->itemsList as $detail) {
                $orderDetail = new OrdersDetails;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_name = $detail->product_name;
                $orderDetail->qty = $detail->quantity;
                $orderDetail->price = $detail->price;
                $orderDetail->product_id = $detail->product_id;
                $orderDetail->save();
            }

            $cart->clear();

            $setting = WebSetting::first();
            Mail::send('newOrder', ['order' => $order,'setting' => $setting], function ($message) {

                $message->to($this->user->email, 'areon.no')->cc('post@areon.no');
                $message->subject('New order from areno.no');

            });

            $orderData = [
                "id" => $order->id,
                "code" => $order->code,
                "total" => $order->total,
            ];

        }
        else{
            return response()->json(['msg' => 'Your cart is empty']);
        }
        endif;

        return response()->json(['data' => $orderData]);
    }


    public function getOrder()
    {

        $orderData = null;
        $order = Orders::where('user_id', $this->user->id)->where('id', Input::get('id'))->first();
        if ($order) {
            $orderData = [
                "data" => $order,
                "sub_total" => $order->sub_total,
                "total" => $order->total,
            ];
        }

        return response()->json([$orderData]);
    }


    protected function getAuthenticatedUser()
    {
        $user = NULL;
        if (JWTAuth::getToken())
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return false;
            }
        return $user;
    }


    protected function genrateOrderCode()
    {
        do {
            $code = $this->getCode(6);
            $data = Orders::where('code', $code)->first();
            if (!$data) return $code;
        } while (true);
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


//////////////////////////////////////////////
    public function paymentNow($id)
    {
        $data = $this->getCustomerStrip();

        if (!$data && $id) return null;

        $cart = new CoolNetCart();

        $stripe = new \Stripe\StripeClient($data['sk']);
//        dd($id);
        if (strpos($id, 'tok_') !== false)

            $charge = $stripe->charges->create([
                'amount' => $cart->total_round() * 100,
                'currency' => $data['currency'],
                'customer' => $this->user->strip_id,
                'card' => $id,
            ]);
        else
            $charge = $stripe->charges->create([
                'amount' => $cart->total_round() * 100,
                'currency' => $data['currency'],
                'customer' => $this->user->strip_id,
                'card' => $id,
            ]);
        if (isset($charge['status']) && $charge['status'] == 'succeeded')
            return $charge;
        else return false;
    }

    public function addCard($token)
    {
        if ($this->user) {
            $data = $this->getCustomerStrip();

            if (!$data) return null;

            $stripe = new \Stripe\StripeClient($data['sk']);

            $resp = $stripe->customers->createSource(
                $data['customerCard'],
                ['source' => $token]
            );

            return $resp;
        }
        else {
            return response()->json(['msg' => 'user not found'], 301);
        }
    }

    public function listCard()
    {
        if ($this->user) {
            $data = $this->getCustomerStrip();

            if (!$data) return null;

            $stripe = new \Stripe\StripeClient($data['sk']);

            $resp = $stripe->customers->allSources(
                $data['customerCard']
            );

            return $resp;
        } else {
            return response()->json(['msg' => 'user not found'], 301);
        }
    }

    public function cardToken()
    {
        $data = $this->getCustomerStrip();

        if (!$data) return null;

        $stripe = new \Stripe\StripeClient($data['sk']);

        if (!post('number'))
            return response()->json(['error' => 'Card Number Required']);

        if (!post('exp_month'))
            return response()->json(['error' => 'Card Month Required']);

        if (!post('exp_year'))
            return response()->json(['error' => 'Card Year Required']);

        if (!post('cvc'))
            return response()->json(['error' => 'Card CVC Required']);

        $resp = $stripe->tokens->create([
            'card' => [
                'number' => post('number'),
                'exp_month' => post('exp_month'),
                'exp_year' => post('exp_year'),
                'cvc' => post('cvc'),
            ],
        ]);

        if (isset($resp['id']) && post('save_card'))
            $this->addCard($resp['id']);

        return response()->json($resp);
    }


    public function getCustomerStrip()
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

        if (!$this->user) return null;

        if ($this->user->strip_id == null)
            $resp = $stripe->customers->create([
                'description' => $this->user->name,
            ]);

        if (isset($resp['id'])) {
            $this->user->strip_id = $resp['id'];
            $this->user->save();
        }

        return ['sk' => $sk, 'customerCard' => $this->user->strip_id, 'currency' => $setting->currency];
    }

    public function deleteCard(){
        if ($this->user) {
        $data = $this->getCustomerStrip();
//        dd($data);
        if (!$data) return response()->json(['error' => 'Data not found']);

        $stripe = new \Stripe\StripeClient($data['sk']);

        $resp = $stripe->customers->deleteSource($this->user->strip_id,post('card_id'));

        return $this->listCard();
        } else {
            return response()->json(['msg' => 'user not found'], 301);
        }
    }
}
