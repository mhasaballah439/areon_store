<?php namespace Coolnet\Pages\Components;

use Input;
use Log;  
use Cms\Classes\ComponentBase; 
use Coolnet\Pages\Models\Pages as PagesModel ;

class Data extends ComponentBase
{  

	public function componentDetails(){

		return [
			'name' => 'Pages',
			'description' => 'Return all Pages'
		];
	}
    
    public function onRun()
    {
        if (!$this->get_detail()){
            return redirect('/404');
        }
          $this->page_detail = $this->page['page_detail'] = $this->get_detail();
    }

  
    public function defineProperties()
    {
        return [
            'slug' => [
                 'title'             => 'View Home',
                 'description'       => 'The most amount of todo items allowed',
                 'default'           => "{{:slug}}",
                 'type'              => 'string',  
            ] 
        ];
    }

    
    public function get_detail()
    { 
        $id = $this->property('slug');
        return PagesModel::where('active',1)->where(function ($query) use($id) {
                $query->where('page_id', $id)
                      ->orWhere('slug','{"slug":"'.$id.'"}' );
            })->first();
    }
 
}