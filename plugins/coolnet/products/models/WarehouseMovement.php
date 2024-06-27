<?php namespace Coolnet\Products\Models;

use Model;
use Coolnet\Products\Models\Wharehouses;
/**
 * Model
 */
class WarehouseMovement extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_products_wherehouse_movement';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'product_id' => 'required',
        'wharehouse_id' => 'required',
        'qty' => 'required',
    ];

    public $belongsTo = [
        'product' => ['Coolnet\Products\Models\Products', 'key' => 'product_id', 'otherKey' => 'id'],
        'warehouse' => ['Coolnet\Products\Models\Wharehouses', 'key' => 'wharehouse_id', 'otherKey' => 'id'],
    ];

}
