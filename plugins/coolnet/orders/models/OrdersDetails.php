<?php namespace Coolnet\Orders\Models;

use Model;

/**
 * Model
 */
class OrdersDetails extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_orders_details';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function getSubTotalProductAttribute(){
        return $this->price * $this->qty;
    }

}
