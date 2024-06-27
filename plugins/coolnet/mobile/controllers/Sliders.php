<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Slider\Models\Slider;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use Coolnet\Menu\Models\Foods;
use Coolnet\Gallery\Models\Gallery;
use Input;

class Sliders extends Controller
{
    public function __construct($theme = null)
    {
        parent::__construct($theme);
    }


    public function index()
    {

        $data = Slider::where('active',1)->orderBy('sort_order')->get();

        $lang = (Input::get('lang'))?Input::get('lang'):'no';
        $catList = [];

         foreach($data as $row)
            $catList[] = [
                "id"          => $row->id,
                "main_title"  => $row->lang($lang)->main_title,
                "sub_title"  => $row->lang($lang)->sub_title,
                "image" => isset($row->image) ? $row->image->getPath() : null,
            ];


        return response()->json($catList);
    }

}
