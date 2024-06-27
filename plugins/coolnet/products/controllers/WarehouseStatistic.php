<?php namespace Coolnet\Products\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Coolnet\Products\Models\WarehouseMovement;
use Coolnet\Products\Models\Wharehouses;
use Coolnet\Products\Models\Products;
class WarehouseStatistic extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Products', 'main-menu-item', 'side-menu-item7');
        $this->addCss("/plugins/coolnet/products/assets/table/datatables.min.css");
        $this->addJs('/plugins/coolnet/products/assets/table/buttons.print.min.js');
        $this->addJs('/plugins/coolnet/products/assets/table/datatable-advanced.js');
        $this->addJs('/plugins/coolnet/products/assets/table/dataTables.buttons.min.js');
        $this->addJs('/plugins/coolnet/products/assets/table/datatables.min.js');
        $this->addJs('/plugins/coolnet/products/assets/table/jszip.min.js');
        $this->addJs('/plugins/coolnet/products/assets/table/pdfmake.min.js');
        $this->addJs('/plugins/coolnet/products/assets/table/vfs_fonts.js');

    }

    public function index(){
        $warehouses = Wharehouses::Active()->get();
        $products = Products::Active()->get();
        $this->vars['warehouses'] = $warehouses;
        $this->vars['products'] = $products;
    }
}
