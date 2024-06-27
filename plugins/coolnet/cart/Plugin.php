<?php namespace Coolnet\Cart;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Coolnet\Cart\Components\CartData' => 'cart' ,
    	];
    }

    public function registerSettings()
    {
    }


}
