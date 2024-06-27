<?php namespace Coolnet\Products\Components;

use Coolnet\Products\Models\Categories;
use Coolnet\Products\Models\Products;
use Input;
use Log;
use Cms\Classes\ComponentBase;

class DetailProduct extends ComponentBase
{

    public function componentDetails()
    {

        return [
            'name' => 'Detail Product',
            'description' => 'Return all Pages'
        ];
    }

    public function onRun()
    {
        $this->product_detail = $this->page['product_detail'] = $this->get_detail();
    }


    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'View product',
                'description' => 'The most amount of todo items allowed',
                'default' => "{{:slug}}",
                'type' => 'string',
            ],
        ];
    }
    

    public function get_detail()
    {
        $id = $this->property('slug');

        return Products::Active()->where(function ($query) use($id) {
            $query->where('id', $id)
                ->orWhere('slug', $id);
        })->first();
    }
}
