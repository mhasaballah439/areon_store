<?php namespace Coolnet\Slider\Components;

use Input;
use Log;  
use Cms\Classes\ComponentBase; 
use Coolnet\Slider\Models\Slider as WebSlider ;

class Slider extends ComponentBase
{  

	public function componentDetails(){

		return [
			'name' => 'Slider',
			'description' => 'Return all Slider'
		];

	}
    
    public function onRun()
    {
    	  $this->web_slider = $this->page['web_slider'] = $this->get_all();
    }

  

    public function get_all()
    { 
        return WebSlider::where('active',1)->orderBy('sort_order')->get();
    }
 
}