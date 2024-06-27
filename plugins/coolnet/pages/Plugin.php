<?php namespace Coolnet\Pages;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Coolnet\Pages\Components\Data' => 'page_detail', 
            'Coolnet\Pages\Components\MenuData' => 'menu_detail'  
    	];
    }

    public function registerSettings()
    {
    }
}
