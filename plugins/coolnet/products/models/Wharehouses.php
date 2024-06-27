<?php namespace Coolnet\Products\Models;

use Model;
use Coolnet\Products\Models\WarehouseMovement;
/**
 * Model
 */
class Wharehouses extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_products_wharehouses';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required'
    ];

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getTotalItemsAttribute(){
        $import = WarehouseMovement::where('wharehouse_id',$this->id)->where('move_type','=','import')->sum('qty');
        $export = WarehouseMovement::where('wharehouse_id',$this->id)->where('move_type','=','export')->sum('qty');
        $total =  $import - $export;
        if ($total > 0)
            return $total;
        else
            return 0;
    }

    public function getProductsImportsAttribute(){
        return WarehouseMovement::where('wharehouse_id',$this->id)->where('move_type','=','import')->get();
    }
    public function getProductsExportAttribute(){
        return WarehouseMovement::where('wharehouse_id',$this->id)->where('move_type','=','export')->get();
    }
}
