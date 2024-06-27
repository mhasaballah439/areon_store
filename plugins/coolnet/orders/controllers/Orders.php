<?php namespace Coolnet\Orders\Controllers;

use Backend\Classes\Controller;
use Coolnet\Orders\Models\Orders as OrdersData;
use BackendMenu;
use Illuminate\Support\Carbon;
use RainLab\User\Models\User;
use Coolnet\Orders\Models\Orders as DataOrders;
class Orders extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Coolnet.Orders', 'main-menu-item');
    }

    public function index()
    {
        $total_order = 0;
        $total_web_orders = 0;
        $ordersList = OrdersData::whereDate('created_at', Carbon::today()->format('Y-m-d'))->get();
        foreach ($ordersList as $order)
        {
            $total_order+=$order->total;
            $total_web_orders+=$order->total;
        }
        $this->vars['web_order_count'] = OrdersData::where('order_from', '=', 'web')->whereDate('created_at', Carbon::today()->format('Y-m-d'))->count();
        $this->vars['total_order'] = $total_order;
        $this->vars['total_web_orders'] = $total_web_orders;
        return $this->asExtension('ListController')->index();
    }

}
