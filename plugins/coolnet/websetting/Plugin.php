<?php namespace Coolnet\Websetting;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Coolnet\WebSetting\Components\Setting' => 'web_setiing'  
    	];
    }

    public function registerSettings()
    {
    }
}
