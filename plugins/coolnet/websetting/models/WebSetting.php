<?php namespace Coolnet\Websetting\Models;

use Model;

/**
 * Model
 */
class WebSetting extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_websetting_data';
    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['about_us','address','open_hours','copyright','home_text','footer_text','map_title','home_title','home_subtitle','feature_title','feature_text','special_title','special_text',"tags" ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $attachOne = [
        'logo' => 'System\Models\File' ,
        'dark_logo' => 'System\Models\File' ,
        'footer_logo' => 'System\Models\File' ,
        'home_image' => 'System\Models\File',
        'product_image' => 'System\Models\File',
        'fav_icon' => 'System\Models\File',
        'overlay' => 'System\Models\File',
        'login_logo' => 'System\Models\File',
    ];

    protected $jsonable = ['open_hours'];

    public function getLocationDetailAttribute(){

        return explode(',', $this->latlng);
    }
    public function getStyleAttribute(){

        return 'assets/css/colors/'.$this->color.'.css';
    }


    public function getTagsListAttribute(){

        return explode(',', $this->tags);
    }


}
