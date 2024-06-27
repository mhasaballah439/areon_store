<?php namespace Coolnet\Products\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;
use Coolnet\Products\Models\Products;
use Coolnet\Products\Models\WarehousLog;
use Coolnet\Products\Models\WarehouseMovement as WarehouseData;
class WharehouseMovementProducts extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Products', 'main-menu-item', 'side-menu-item4');
    }

    public function index(){
        $this->vars['products_lists'] = Products::Active()->get();
    }

    public function onImportWarehouse(){
        $user = BackendAuth::getUser();
        foreach (post('quantity') as $k => $v){
            if ($v > 0){
                $warehouse = new WarehouseData();
                $warehouse->product_id = $k;
                $warehouse->wharehouse_id = 1;
                $warehouse->qty = $v;
                $warehouse->move_type = 'import';
                $warehouse->save();

                $log = new WarehousLog();
                $log->employee_name = $user->first_name.' '.$user->last_name;
                $log->product_id = $k;
                $log->move_type = 'import';
                $log->wharehouse_id = 1;
                $log->to_warehouse = 1;
                $log->qty = $v;
                $log->save();
            }
        }
        return redirect()->back()->with('success','Data stored successfully');
    }
}
