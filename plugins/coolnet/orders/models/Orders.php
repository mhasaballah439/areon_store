<?php namespace Coolnet\Orders\Models;

use Model;
use BackendAuth;
use Coolnet\Products\Models\WarehouseMovement;
use Coolnet\Products\Models\WarehousLog;
use Coolnet\Products\Models\Wharehouses;
/**
 * Model
 */
class Orders extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_orders_orders';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    function getStatusIdOptions(){
        return Status::where('active',1)->lists('name','id');
    }

    public $hasMany = [
        'detailData' => ['Coolnet\Orders\Models\OrdersDetails', 'key' => 'order_id', 'otherKey' => 'id']
    ];

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User', 'key' => 'user_id', 'otherKey' => 'id'],
        'status' => ['Coolnet\Orders\Models\Status', 'key' => 'status_id', 'otherKey' => 'id'],
        'address' => ['Coolnet\Profile\Models\Address', 'key' => 'address_id', 'otherKey' => 'id']
    ];

    public function getSubTotalAttribute(){
        $sum = 0;
        foreach ($this->detailData as $item)
            $sum+= $item->sub_total_product;
        return $sum;
    }
    public function getTotalAttribute(){
        return $this->sub_total;
    }

    public function getWarehouseIdOptions(){
        return Wharehouses::Active()->lists('name','id');
    }
    public function afterSave(){
        $user = BackendAuth::getUser();
        if ($this->warehouse_id == 0){
            foreach ($this->detailData as $detail) {
                $warehouse = new WarehouseMovement;
                $warehouse->product_id = $detail->product_id;
                $warehouse->wharehouse_id = $this->warehouse_id;
                $warehouse->qty = $detail->qty;
                $warehouse->move_type = 'export order ('.$this->code.')';
                $warehouse->save();

                $log = new WarehousLog;
                $log->employee_name = $user->first_name.' '.$user->last_name;
                $log->product_id = $detail->product_id;
                $log->move_type = 'export order ('.$this->code.')';
                $log->wharehouse_id = $this->warehouse_id;
                $log->qty = $detail->qty;
                $log->save();
            }
        }
    }
}
