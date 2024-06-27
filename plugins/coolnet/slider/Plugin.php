<?php namespace Coolnet\Slider;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Coolnet\Slider\Components\Slider' => 'site_slider'  
    	];
    }

    public function registerSettings()
    {
    }
}
