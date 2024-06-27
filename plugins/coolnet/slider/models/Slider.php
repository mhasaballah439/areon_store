<?php namespace Coolnet\Slider\Models;

use Model;

/**
 * Model
 */
class Slider extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Sortable;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_slider_data';
    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['main_title','sub_title','btn_text','top_title'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];


    public $attachOne = [
        'image' => 'System\Models\File',
        'image_small' => 'System\Models\File'
    ];

}
