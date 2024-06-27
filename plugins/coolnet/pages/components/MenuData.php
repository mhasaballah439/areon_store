<?php namespace Coolnet\Pages\Components;

use Input;
use Log;  
use Cms\Classes\ComponentBase; 
use Coolnet\Pages\Models\Pages as PagesModel ;
use Request;

class MenuData extends ComponentBase
{  

	public function componentDetails(){

		return [
			'name' => 'Pages',
			'description' => 'Return all Pages'
		];
	}
    
    public function onRun()
    {
          $this->curLink = $this->page['curLink'] = Request::path() ;
          $this->top_nav = $this->page['top_nav'] = $this->top_nav();
          $this->footer_nav = $this->page['footer_nav'] = $this->footer_nav();
    }



    public function top_nav()
    { 
        return PagesModel::where('parent_id',0)->where('active',1)->where('top_nav',1)->get();
    }
    public function footer_nav()
    { 
        return PagesModel::where('parent_id',0)->where('active',1)->where('footer_nav',1)->get();
    }
 
}