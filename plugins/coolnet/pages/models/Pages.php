<?php namespace Coolnet\Pages\Models;

use Model;
use Cms\Classes\Controller as BaseController;
use Cms\Classes\Page;
use Cms\Classes\Theme;
/**
 * Model
 */
class Pages extends Model
{
    use \October\Rain\Database\Traits\Validation; 
    use \October\Rain\Database\Traits\SoftDelete; 
    use \October\Rain\Database\Traits\NestedTree;

    protected $dates = ['deleted_at']; 


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_pages_text_page';
    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['title','detail' ,'seo_title' ,'sey_keyword' ,'seo_desc'];

    /**
     * @var array Validation rules
     */
    public $rules = [ 
        'title'      => 'required',
        'page_id'      => 'required',
    ];

    public $attachOne = [
        'icon' => 'System\Models\File' ,
        'image' => 'System\Models\File',
    ];

    public function beforeSave(){
        if($this->page_id == "text_pages")
            $this->slug = '{"slug":"'.str_slug($this->title, "-").'"}';
        else
            $this->slug = NULL; 
    }

    public function getPageIdOptions(){
        $hide_page = ["blog_detail","404","change-password","deactivate-account","my-orders","print_order","profile","saveOrder","cart","text_pages","order","cart","account","payment"];
        $allPages = Page::sortBy('baseFileName')->lists('title', 'baseFileName'); 
        $pages['text_pages'] = "For Text Page";
        $pages['external_url'] = "For External URL";
        $pages['#'] = "For Main Menu";
        foreach ($allPages as $key => $value) 
            if(!in_array($key,$hide_page)){
            $pages[$key] = "{$value}";
        }

        return $pages;
    }

    public function filterFields($fields, $context = null)
    {
        $fields->detail->hidden = 1;
        $fields->external_url->hidden = 1;

        if($this->page_id == "text_pages")
            $fields->detail->hidden = 0;
        elseif($this->page_id == "external_url")
            $fields->external_url->hidden = 0;

    } 

    public function getLinkHref($routePersistence = true)
    {
        $this->controller = new BaseController;

        $url = '#';

        $parameters = (array)json_decode($this->slug);
        //dd($parameters);
        if ($this->page_id != "external_url") {
            if (!$this->external_url) {
                $url = $this->controller->pageUrl($this->page_id, $parameters, $routePersistence);
            } else {
                $url = $this->external_url;
            }
        } 
        return $url;
    }
}
