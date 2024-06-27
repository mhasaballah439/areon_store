<?php namespace Coolnet\Products\Components;

use Coolnet\Products\Models\Categories;
use Coolnet\Products\Models\Products;
use Input;
use Log;
use Cms\Classes\ComponentBase;

class ProductsData extends ComponentBase
{

    public function componentDetails()
    {

        return [
            'name' => 'Pages',
            'description' => 'Return all Pages'
        ];
    }

    public function onRun()
    {
        $this->product_category = $this->page['product_category'] = $this->getSingleCat();
        $this->category = $this->page['category'] = $this->getCat();

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

    public function getSingleCat()
    {
        $id = $this->property('slug');
        $cat = Categories::Active()->where(function ($query) use ($id) {
            $query->where('id', $id)
                ->orWhere('slug', $id);
        })->first();
        if (isset($cat))
        return $cat->children()->where('active',1)->get();
    }

    public function getCat()
    {
        $id = $this->property('slug');
        return Categories::Active()->where(function ($query) use ($id) {
            $query->where('id', $id)
                ->orWhere('slug', $id);
        })->first();

    }
}
