<?php namespace Coolnet\Products\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class WarehouseLog extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];
    
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Products', 'main-menu-item', 'side-menu-item4');
    }
}
