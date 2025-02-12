<?php namespace Coolnet\Products\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Products extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Products', 'main-menu-item', 'side-menu-item');
        $this->addJs('/plugins/coolnet/products/assets/js/app.js'); //this should inject app.js
    }


}
