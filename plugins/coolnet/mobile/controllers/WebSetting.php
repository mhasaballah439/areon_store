<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Menu\Models\Setting;
use Coolnet\Menu\Models\Times;
use Coolnet\Websetting\Models\WebSetting as Settings;
use Coolnet\Menu\Models\Setting as OrderSetting;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use Input;

class WebSetting extends Controller
{
    public function __construct($theme = null)
    {
        parent::__construct($theme);
    }


    public function index()
    {

        $site_setting = Settings::first();

        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';

        $jsonData = [
            "address" => $site_setting->lang($lang)->address,
            "email" => $site_setting->email,
            "phone" => $site_setting->phone,
            "fax" => $site_setting->fax,
            "open_hours" => $site_setting->lang($lang)->open_hours,
            "facebook" => $site_setting->facebook,
            "twitter" => $site_setting->twitter,
            "google" => $site_setting->google,
            "instagram" => $site_setting->instagram,
            "whatsapp" => $site_setting->whatsapp,
            "tumblr" => $site_setting->tumblr,
            "skype" => $site_setting->skype,
            "snapchat" => $site_setting->snapchat,
            "pinterest" => $site_setting->pinterest,
            "linkedin" => $site_setting->linkedin,
            "telegram" => $site_setting->telegram,
            "youtube" => $site_setting->youtube,
            "flickr" => $site_setting->flickr,
            "tiktok" => $site_setting->tiktok,
            "messenger" => $site_setting->messenger,
            "copyright" => $site_setting->lang($lang)->copyright,
            "home_text" => $site_setting->lang($lang)->home_text,
            "footer_text" => $site_setting->lang($lang)->footer_text,
            "latlng" => $site_setting->latlng,
            "map_title" => $site_setting->lang($lang)->map_title,
            "logo" => isset($site_setting->logo) ? $site_setting->logo->getPath() : null,
            "dark_logo" => isset($site_setting->dark_logo) ? $site_setting->dark_logo->getPath() : null,
            "footer_logo" => isset($site_setting->footer_logo) ? $site_setting->footer_logo->getPath() : null,
            "product_image" => isset($site_setting->product_image) ? $site_setting->product_image->getPath() : null,
            "overlay" => isset($site_setting->logo) ? $site_setting->overlay->getPath() : null,
            "app" => [
                "status" => $site_setting->mobile_discount_status,
                "mobile_discount" => $site_setting->mobile_discount,
            ]
        ];

        return response()->json($jsonData);
    }

}
