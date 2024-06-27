<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Data\Models\ProductsData;
use Coolnet\Data\Models\TeamsData;
use Coolnet\Pages\Models\Pages as PagesModel;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use Input;

class Data extends Controller
{
    public function __construct($theme = null)
    {
        parent::__construct($theme);
    }

    public function getTextPages()
    {
        $pages = PagesModel::where('parent_id', 0)->where('active', 1)->where('top_nav', 1)
            ->where('detail', '!=', '')->get();
        $textList = [];
        foreach ($pages as $page) {
            $textList[] = [
                'id' => $page->id,
                'title' => $page->title,
            ];
        }

        return response()->json($textList);
    }

    public function getPageDetail()
    {
        $page = PagesModel::where('id', Input::get('id'))->first();
        $textList = [];

        $textList[] = [
            'id' => $page->id,
            'title' => $page->title,
            'detail' => strip_tags($page->detail),
            'image' => isset($page->image) ? $page->image->getPath() : null,
        ];


        return response()->json($textList);
    }
}
