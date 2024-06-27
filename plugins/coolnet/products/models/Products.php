<?php namespace Coolnet\Products\Models;

use Model;
use Auth;
use Coolnet\Products\Models\WarehouseMovement;
/**
 * Model
 */
class Products extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Purgeable;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_products_products';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'short_title' => 'required',
        'title' => 'required',
        'desc' => 'required',
    ];

    protected $jsonable = ['details'];
    protected $slugs = ['slug' => 'short_title'];


    protected $purgeable = ['main_cat','sub_cat'];

    public $belongsTo = [
        'category' => ['Coolnet\Products\Models\Categories', 'key' => 'cat_id', 'otherKey' => 'id'],
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

    function getMainCatOptions(){
       return Categories::where('parent_id',0)->lists('name','id');
    }

    function getSubCatOptions(){
       return Categories::where('active',1)->where('parent_id',$this->main_cat)->lists('name','id');
    }

    function getCatIdOptions() {
        return Categories::where('active',1)->where('parent_id',$this->sub_cat)->lists('name','id');
    }
    public function getPriceProductAttribute(){
        if (Auth::check()){
            if (Auth::getUser()->user_role == 'company')
                if ($this->offer_price > 0)
                {
                    $price = $this->offer_price;
                } else{
                    $price = $this->price_company;
                }

            else
            {
                if ($this->offer_price > 0)
                {
                    $price = $this->offer_price;
                } else{
                    $price = $this->price_user;
                }
            }
        }else{
            if ($this->offer_price > 0)
            {
                $price = $this->offer_price;
            } else{
                $price =  $this->price_user;
            }
        }

        return $price;
    }

    public function getOldPriceProductAttribute(){
        if (Auth::check()){
            if (Auth::getUser()->user_role == 'company')
                    $price = $this->price_company;
            else
            {
             $price = $this->price_user;
            }
        }else{
          $price =  $this->price_user;
        }

        return $price;
    }

//    public function getTotalProductsAttribute(){
//        $import = ProductsMovement::where('product_id',$this->id)->where('move_type','=','import')->sum('qty');
//        $export = ProductsMovement::where('product_id',$this->id)->where('move_type','=','export')->sum('qty');
//        $total =  $import - $export;
//        return $total > 0 ? $total : 0;
//    }

    public function afterFetch(){
        if (isset($this->category)){
            $this->sub_cat = $this->category->parent_id;
            $this->main_cat = $this->category->parentCat->parent_id;
        }

    }
    public function getCatDataAttribute(){

        if (isset($this->category) && $this->category->name != null){
            if (isset($this->category->parentCat) && $this->category->parentCat->name !=null)
            return $this->category->parentCat->name.'-->'.$this->category->name;
        }
        else{
            return isset($this->category) ? $this->category->name : '';
        }

    }

    public function getWarehouseTotalAttribute(){
        $import = WarehouseMovement::where('product_id',$this->id)->where('move_type','=','import')->sum('qty');
        $export = WarehouseMovement::where('product_id',$this->id)->where('move_type','=','export')->sum('qty');
        $total =  $import - $export;
        if ($total > 0)
            return $total;
        else
            return 0;
    }
}
