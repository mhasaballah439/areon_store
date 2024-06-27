<?php namespace Coolnet\Cart\Models;

use Model;

/**
 * Model
 */
class CartData extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_cart_data';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'itemsList' => ['Coolnet\Cart\Models\CartItem', 'key' => 'cart_id' , 'otherKey' => 'id' ]
    ];

    //tax_total
    public function getTaxTotalNumberAttribute()
    {
        $tax_total =  $this->itemsList()->sum('tax_total');
        return number_format($tax_total,2);
    }

    public function getTaxTotalRoundAttribute()
    {
        return round($this->tax_total);
    }

    //sub_total
    public function getSubTotalNumberAttribute()
    {

        $sub_total = ($this->sub_total + $this->itemsList()->sum('discount_total')) - $this->itemsList()->sum('tax_total');
        return number_format($sub_total,2);
    }

    public function getSubTotalRoundAttribute()
    {
        $sub_total = ($this->sub_total + $this->itemsList()->sum('discount_total')) - $this->itemsList()->sum('tax_total');
        return round($sub_total);
    }

    //total
    public function getTotalNumberAttribute()
    {
        return number_format($this->total,2);
    }

    public function getTotalRoundAttribute()
    {
        return round($this->total);
    }

    //grand_total
    public function getGrandTotalNumberAttribute()
    {
        return number_format($this->grand_total,2);
    }

    public function getGrandTotalRoundAttribute()
    {
        return round($this->grand_total);
    }

    //discount_total
    public function getDiscountTotalNumberAttribute()
    {
        $discount_total = $this->itemsList()->sum('discount_total');
        return number_format($discount_total,2);
    }

    public function getDiscountTotalRoundAttribute()
    {
        return round($this->discount_total);
    }

    //tmps_price
    public function getTpmsPriceNumberAttribute()
    {
        return number_format($this->tpms_price,2);
    }

    public function getTpmsPriceRoundAttribute()
    {
        return round($this->tpms_price);
    }
    //tpms_total
    public function getTpmsTotalNumberAttribute()
    {
        return number_format($this->tpms_total,2);
    }

    public function getTpmsTotalRoundAttribute()
    {
        return round($this->tpms_total);
    }

//    public function getCouponTotalAttribute(){
//        return $this->total * $this->couponData->coupon_rate/100;
//    }
}
