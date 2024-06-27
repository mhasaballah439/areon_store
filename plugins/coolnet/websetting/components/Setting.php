<?php namespace Coolnet\WebSetting\Components;

use Input;
use Log;  
use Cms\Classes\ComponentBase; 
use Coolnet\Websetting\Models\WebSetting ;

class Setting extends ComponentBase
{  

	public function componentDetails(){

		return [
			'name' => 'Web Setting',
			'description' => 'Return all web setting'
		];

	}
    
    public function onRun()
    {
    	  $this->web_setting = $this->page['web_setting'] = $this->get_setting();
    }

  

    public function get_setting()
    { 
        return WebSetting::first();
    }
 
}