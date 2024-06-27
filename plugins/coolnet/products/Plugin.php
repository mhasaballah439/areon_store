<?php namespace Coolnet\Products;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Coolnet\Products\Components\CategoriesData' => 'categories',
            'Coolnet\Products\Components\ProductsData' => 'products',
            'Coolnet\Products\Components\DetailProduct' => 'detailProduct',
        ];
    }

    public function registerSettings()
    {
    }
}
