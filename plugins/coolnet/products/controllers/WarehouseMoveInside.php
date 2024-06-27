<?php namespace Coolnet\Products\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;
use Input;
use Coolnet\Products\Models\Products;
use Coolnet\Products\Models\WarehousLog;
use Coolnet\Products\Models\Wharehouses;
use Coolnet\Products\Models\WarehouseMovement as WarehouseData;
class WarehouseMoveInside extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Products', 'main-menu-item', 'side-menu-item5');
    }

    public function index(){
        $this->vars['warehouses_list'] = Wharehouses::Active()->get();
        $this->vars['products_lists'] = Products::Active()->get();
    }

    public function onMoveProductsWarehouse(){
        $user = BackendAuth::getUser();
        foreach (post('warehouse_movement') as $k => $v){
            if (isset($v['product_id'],$v['from_warehouse'],$v['to_warehouse'],$v['quantity'])){
                if ($v['quantity'] > 0 && $v['from_warehouse'] > 0){
                    if ($v['from_warehouse'] == 1){
                        $warehouse = new WarehouseData();
                        $warehouse->product_id = $v['product_id'];
                        $warehouse->wharehouse_id = $v['to_warehouse'];
                        $warehouse->qty = $v['quantity'];
                        $warehouse->move_type = 'import';
                        $warehouse->save();

                        $warehouse = new WarehouseData();
                        $warehouse->product_id = $v['product_id'];
                        $warehouse->wharehouse_id = 1;
                        $warehouse->qty = $v['quantity'];
                        $warehouse->move_type = 'export';
                        $warehouse->save();

                        $log = new WarehousLog();
                        $log->employee_name = $user->first_name.' '.$user->last_name;
                        $log->product_id = $v['product_id'];
                        $log->move_type = 'export';
                        $log->wharehouse_id = 1;
                        $log->to_warehouse = $v['to_warehouse'];
                        $log->qty = $v['quantity'];
                        $log->save();

                        $log = new WarehousLog();
                        $log->employee_name = $user->first_name.' '.$user->last_name;
                        $log->product_id = $v['product_id'];
                        $log->move_type = 'import';
                        $log->wharehouse_id = 1;
                        $log->to_warehouse = $v['to_warehouse'];
                        $log->qty = $v['quantity'];
                        $log->save();
                    }else{
                        $warehouse = new WarehouseData();
                        $warehouse->product_id = $v['product_id'];
                        $warehouse->wharehouse_id = $v['to_warehouse'];
                        $warehouse->qty = $v['quantity'];
                        $warehouse->move_type = 'import';
                        $warehouse->save();

                        $warehouse = new WarehouseData();
                        $warehouse->product_id = $v['product_id'];
                        $warehouse->wharehouse_id = $v['from_warehouse'];
                        $warehouse->qty = $v['quantity'];
                        $warehouse->move_type = 'export';
                        $warehouse->save();

                        $log = new WarehousLog();
                        $log->employee_name = $user->first_name.' '.$user->last_name;
                        $log->product_id = $v['product_id'];
                        $log->move_type = 'export';
                        $log->wharehouse_id = $v['from_warehouse'];
                        $log->to_warehouse = $v['to_warehouse'];
                        $log->qty = $v['quantity'];
                        $log->save();

                        $log = new WarehousLog();
                        $log->employee_name = $user->first_name.' '.$user->last_name;
                        $log->product_id = $v['product_id'];
                        $log->move_type = 'import';
                        $log->wharehouse_id = $v['from_warehouse'];
                        $log->to_warehouse = $v['to_warehouse'];
                        $log->qty = $v['quantity'];
                        $log->save();
                    }

                }
            }
        }
        return redirect()->back()->with('success','Data stored successfully');
    }
}
