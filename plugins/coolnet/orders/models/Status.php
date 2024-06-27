<?php namespace Coolnet\Orders\Models;

use Model;

/**
 * Model
 */
class Status extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_orders_status';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
