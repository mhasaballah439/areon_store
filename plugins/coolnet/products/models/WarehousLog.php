<?php namespace Coolnet\Products\Models;

use Model;

/**
 * Model
 */
class WarehousLog extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_products_warehouse_log';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'product' => ['Coolnet\Products\Models\Products', 'key' => 'product_id', 'otherKey' => 'id'],
        'warehouse' => ['Coolnet\Products\Models\Wharehouses', 'key' => 'wharehouse_id', 'otherKey' => 'id'],
        'warehouse_to' => ['Coolnet\Products\Models\Wharehouses', 'key' => 'to_warehouse', 'otherKey' => 'id'],
    ];
}
