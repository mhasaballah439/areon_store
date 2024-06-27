<?php namespace Coolnet\Products\Models;

use Model;

/**
 * Model
 */
class Categories extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\NestedTree;

    protected $dates = ['deleted_at'];

    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['name'];
    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_products_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required'
    ];

    protected $slugs = ['slug' => 'name'];

    public $attachOne = [
        'image' => 'System\Models\File',
    ];

    public $hasMany = [
        'products' => ['Coolnet\Products\Models\Products', 'key' => 'cat_id', 'otherKey' => 'id']
    ];

    public $belongsTo = [
        'parentCat' => ['Coolnet\Products\Models\Categories', 'key' => 'parent_id', 'otherKey' => 'id'],
    ];

    public $hasManyThrough = [
        'products_cat' => [
            'Coolnet\Products\Models\Products',
            'key'        => 'parent_id',
            'through'    => 'Coolnet\Products\Models\Categories',
            'throughKey' => 'cat_id',
            'otherKey'   => 'id',
        ],
    ];

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

    public function getIndexTitleAttribute(){
        
        if (isset($this->parentCat) && $this->parentCat->name != null)
            return $this->parentCat->name.'-->'.$this->name;
        else
            return $this->name;
    }
}
