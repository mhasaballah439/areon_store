<?php namespace Coolnet\Orders\Components;

use Cms\Classes\ComponentBase;
use Auth;
use Input;
use Coolnet\Orders\Models\Orders;


class OrdersData extends ComponentBase
{

    public function componentDetails()
    {

        return [
            'name' => 'Checkout Data',
            'description' => 'Return all Checkout Data'
        ];

    }

    public function onRun()
    {
        $this->orders_list = $this->page['orders_list'] = $this->getUserOrders();
    }

    public function getUserOrders(){
        if (Auth::check())
        return Orders::where('user_id',Auth::getUser()->id)->get();
    }
}
