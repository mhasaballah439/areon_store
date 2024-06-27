<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Orders\Models\Orders;
use Coolnet\Profile\Models\Address;
use Illuminate\Http\Response;
use Input;
use Lang;
use RainLab\User\Models\User;
use JWTAuth;

class ProfileApi extends Controller
{
    var $user;

    public function __construct($theme = null)
    {
        parent::__construct($theme);
        $this->user = $this->getAuthenticatedUser();
    }


    public function myProfile()
    {
        if ($this->user):

            $data = [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'is_activated' => $this->user->is_activated,
                'mobile' => $this->user->mobile,
                'user_role' => $this->user->user_role,
                'company_name' => $this->user->company_name,
                'company_number' => $this->user->company_number,
                'address' => $this->get_address(),

            ];
            return response()->json($data);
        endif;
    }

    public function logout()
    {

        if ($this->user) {

            JWTAuth::parseToken()->invalidate();
            return \response()->json([
                'msg' => 'Logout success'
            ]);
        } else {
            return \response()->json([
                'msg' => 'user not found'
            ]);
        }
    }

    public function updateProfile()
    {
        if (Input::hasFile('avatar')) {
            $this->user->avatar = Input::file('avatar');
        }
        

        if (post('password') && strlen(post('password')) && !$this->user->checkHashValue('password', post('password_current'))) {
            return response()->json(['error' => 'Invalid current pass']);
        }

        $this->user->fill(post());
        $this->user->save();


        $data = [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'is_activated' => $this->user->is_activated,
            'mobile' => $this->user->mobile,
            'address' => $this->get_address(),
        ];

        return response()->json($data);

    }

    public function deactivate()
    {
        if (!$this->user) {
            return response()->json(['error' => 'User Not Found']);
        }

        if (!$this->user->checkHashValue('password', post('password'))) {
            return response()->json(['error' => Lang::get('rainlab.user::lang.account.invalid_deactivation_pass')]);
        }

        JWTAuth::parseToken()->invalidate();
        $this->user->delete();

        return response()->json(['success' => Lang::get('rainlab.user::lang.account.success_deactivation')]);


    }


//////////////////////////////////////////////////////////////////
    public function myAddress()
    {

        return response()->json($this->get_address());
    }


    public function addAddress()
    {
        if ($this->user) {
            $address = new Address;
            $address->user_id = $this->user->id;
            $address->city = Input::get('city');
            $address->street = Input::get('street');
            $address->full_name = Input::get('full_name');
            $address->mobile = Input::get('mobile');
            $address->building = Input::get('building');
            $address->zip_code = Input::get('zip_code');
            $address->save();
            return response()->json($this->get_address());
        } else {
            return response()->json(['msg' => 'user not found'], 401);
        }

    }

    public function deleteAddress()
    {


        $addressData = Address::where('id', Input::get('id'))->where('user_id', $this->user->id)->first();

        if (!$addressData) {
            return response()->json(
                ['error' => 'Address Not Found'],
                Response::HTTP_NOT_FOUND
            );
        }
        $addressData->delete();

        return response()->json($this->get_address());
    }


////////////////////////////////////////////////////////////////////

    protected function getAuthenticatedUser()
    {

        $user = NULL;
        if (JWTAuth::getToken())
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return false;
            }
        return $user;
    }

    private function get_address()
    {
        $address = [];

        $addressList = Address::where('user_id', $this->user->id)->orderBy('id', 'DESC')->get();

        foreach ($addressList as $row)
            $address[] = [
                "id" => $row->id,
                "city" => $row->city,
                "street" => $row->street,
                "building" => $row->building,
                "full_name" => $row->full_name,
                "mobile" => $row->mobile,
                "zip_code" => $row->zip_code,
            ];
        return $address;
    }

    public function userOrders()
    {
        if ($this->user) {
            $orders = Orders::where('user_id', $this->user->id)->get();
            $ordersList = [];
            foreach ($orders as $order){
                $orderDetails = [];
                if (isset($order->detailData)){
                    foreach ($order->detailData as $detail){
                        $orderDetails[] = [
                          'order_id' => $detail->order_id,
                          'product_id' => $detail->product_id,
                          'product_name' => $detail->product_name,
                          'qty' => $detail->qty,
                          'price' => $detail->price,
                        ];
                    }
                }
                $ordersList[] = [
                  'id' => $order->id,
                  'address_id' => $order->address_id,
                  'code' => $order->code,
                  'note' => $order->note,
                  'status' => isset($order->status) ? $order->status->name : null,
                  'delivery_price' => $order->delivery_price,
                  'delivery' => $order->delivery,
                  'order_from' => $order->order_from,
                  'is_payment' => $order->is_payment,
                  'detail' => $orderDetails ? $orderDetails : null,
                ];
            }

            return response()->json($ordersList);
        }
    }
}
