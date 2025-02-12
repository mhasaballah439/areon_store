<?php namespace Coolnet\Slider\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Slider extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'coolnet.slider' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Slider', 'main-menu-slider');
    }
}
