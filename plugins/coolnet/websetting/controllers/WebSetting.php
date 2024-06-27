<?php namespace Coolnet\Websetting\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class WebSetting extends Controller
{
    public $implement = [        'Backend\Behaviors\FormController'    ];
    
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'coolnet.websetting' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Websetting', 'main-menu-websetting');
    }
}
