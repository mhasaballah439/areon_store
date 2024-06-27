<?php namespace Coolnet\Cart\Models;

use Model;

/**
 * Model
 */
class CartItem extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    protected $jsonable = ['options'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_cart_item';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $guarded = [];
    public $belongsTo = [
        'product' => ['Coolnet\Products\Models\Products', 'key' => 'product_id' , 'otherKey' => 'id' ]
    ];
    //price
    public function getPriceNumberAttribute()
    {
        return number_format($this->price,2);
    }

    public function getPriceRoundAttribute()
    {
        return round($this->price);
    }

    //tax_total
    public function getTaxTotalNumberAttribute()
    {
        return number_format($this->tax_total,2);
    }

    public function getTaxTotalRoundAttribute()
    {
        return round($this->tax_total);
    }

    //discount_total
    public function getDiscountTotalNumberAttribute()
    {
        return number_format($this->discount_total,2);
    }

    public function getDiscountTotalRoundAttribute()
    {
        return round($this->discount_total);
    }

    //item_total
    public function getItemTotalNumberAttribute()
    {
        return number_format($this->item_total,2);
    }

    public function getItemTotalRoundAttribute()
    {
        return round($this->item_total);
    }

}
