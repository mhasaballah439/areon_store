<?php namespace Coolnet\Orders;

use System\Classes\PluginBase;
use Event;
use Mail;
use Auth;
class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Coolnet\Orders\Components\Checkout' => 'checkout_payment',
            'Coolnet\Orders\Components\OrdersData' => 'user_orders',
        ];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Event::listen('order.new', function ($order) {
            Mail::send('newOrder', compact($order), function ($message) {

                $message->to(Auth::getUser()->email, 'areon.no');
                $message->subject('New order from areno.no');

            });
        });
    }
}
