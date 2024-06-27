<?php namespace Coolnet\Products\Components;

use Coolnet\Products\Models\Categories;
use Coolnet\Products\Models\Products;
use Input;
use Log;
use Cms\Classes\ComponentBase;

class CategoriesData extends ComponentBase
{

    public function componentDetails()
    {

        return [
            'name' => 'categories',
            'description' => 'Return all categories'
        ];
    }

    public function onRun()
    {
        $this->categories_home_list = $this->page['categories_home_list'] = $this->getCategoriesHome();
        $this->categories_list = $this->page['categories_list'] = $this->getAllCategories();
        $this->search_products = $this->page['search_products'] = $this->getSearchProducts();
    }

    public function getCategoriesHome()
    {
        return Categories::Active()->where('parent_id',0)->where('is_home',1)->take(3)->get();
    }

    public function getAllCategories()
    {
        return Categories::Active()->where('parent_id',0)->get();
    }

    public function getSearchProducts(){
       return Products::Active()->where('title','LIKE','%'.Input::get('query').'%')
            ->orWhere('desc','LIKE','%'.Input::get('query').'%')->paginate(18);
    }
}
