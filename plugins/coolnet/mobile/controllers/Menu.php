<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;

use Coolnet\Menu\Models\Categories;
use Coolnet\Menu\Models\EntreesCat;
use Coolnet\Menu\Models\Foods;
use Coolnet\Menu\Models\Entrees;

use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use Input;

class Menu extends Controller
{
    public function __construct($theme = null)
    {
        parent::__construct($theme);
    }


    public function categories()
    {

        $data = Categories::where('active', 1)->where('parent_id', 0)
            ->orderBy('sort_order')->get();

        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';
        $jsonData = array();

        foreach ($data as $row) {

            $sup_cat = [];
            if ($row->getChildCount())
                foreach ($row->getChildren() as $item) {

                    $sup_cat[] = [
                        "id" => $item->id,
                        "type" => "food",
                        "name" => $item->name,
                        "top_note" => $item->lang($lang)->top_note,
                        "down_note" => $item->lang($lang)->down_note,
                    ];
                }

            $jsonData[] =
                [
                    "id" => $row->id,
                    "name" => $row->name,
                    "type" => "food",
                    "top_note" => $row->lang($lang)->top_note,
                    "down_note" => $row->lang($lang)->down_note,
                    "sup_cat" => $sup_cat,
                ];
        }

        $data = []; //EntreesCat::where('active',1)->orderBy('sort_order')->get(); 

        foreach ($data as $row) {

            $jsonData[] = [
                "id" => $row->id,
                "type" => "entrees",
                "name" => $row->lang($lang)->name,
                "top_note" => $row->lang($lang)->note,
                "down_note" => null,
                "image" => $row->icon
            ];
        }

        if (!$jsonData) {
            return response()->json([
                'error' => 's001',
                'msg' => 'categories not found'
            ]);
        } else {
            return response()->json($jsonData);
        }
    }


    public function category($type, $id)
    {
        $jsonData = null;
        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';

        if ($type == "food") {
            $data = Categories::find($id);

            if ($data):
                $productsList = null;
                $supCategory = null;
                $products = $data->foodList;
                foreach ($products as $product) {

                    $optionsList = null;
                    $entreesList = null;
                    $allergyList = null;
                    if ($product->options and count($product->options))
                        foreach ($product->options as $option) {
                            $optionsList[] = [
                                'id' => $option->id,
                                'name' => $option->lang($lang)->name,
                                'icon' => ($option->icon) ? $option->icon->getThumb(24, 24) : null
                            ];
                        }

                    if ($product->entrees_cat and count($product->entrees_cat))
                        foreach ($product->entrees_cat as $entrees) {
                            $listDetail = null;
                            $dataList = $product->getEntreesList($entrees->id);
                            if ($dataList and count($dataList))
                                foreach ($dataList as $row) {
                                    $listDetail[] = [
                                        "id" => $row->id,
                                        "cat_id" => $row->cat_id,
                                        "type" => "entrees",
                                        "title" => $row->lang($lang)->name,
                                        "description" => $row->text,
                                        "price" => $row->price,
                                        "image" => ($row->image) ? $row->image->getPath() : null,
                                        "thumb" => ($row->image) ? $row->image->getThumb(200, 200) : null,
                                    ];
                                }
                            $entreesList[] = [
                                'id' => $entrees->id,
                                'name' => $entrees->lang($lang)->name,
                                'icon' => ($entrees->icon) ? $entrees->icon->getThumb(50, 50) : null,
                                'list' => $listDetail
                            ];
                        }

                    if ($product->allergy and count($product->allergy))
                        foreach ($product->allergy as $allergy) {
                            $allergyList[] = [
                                'name' => $allergy->lang($lang)->name,
                                'code' => $allergy->code,
                                'icon' => ($allergy->icon) ? $allergy->icon->getThumb(24, 24) : null
                            ];
                        }

                    $productsList[] = [
                        "id" => $product->id,
                        "cat_id" => $product->cat_id,
                        "min_person" => $product->min_person,
                        "type" => "food",
                        "special" => $product->special,
                        "title" => $product->lang($lang)->title,
                        "note" => $product->lang($lang)->note,
                        "description" => $product->desc,
                        "alert_person" => $product->alert_person ? $product->alert_person : null,
                        "price" => (isset($product->view_price['val'])) ? $product->view_price['val'] : null,
                        "price_option" => $product->price_option,
                        "spicy_option" => $product->spicy_option,
                        "is_sous" => $product->is_sous,
                        "is_tilbehor" => $product->is_tilbehor,
                        "options" => $optionsList,
                        "entrees_cat" => $entreesList,
                        "allergy" => $allergyList,
                        "image" => ($product->image) ? $product->image->getPath() : null,
                        "thumb" => ($product->image) ? $product->image->getThumb(200, 200) : null,
                    ];
                }

                if ($data->getChildCount())
                    foreach ($data->getChildren() as $item) {
                        $products = $item->foodList;
                        $productsSupList = null;
                        foreach ($products as $product) {

                            $optionsList = null;
                            $entreesList = null;
                            $allergyList = null;
                            if ($product->options and count($product->options))
                                foreach ($product->options as $option) {
                                    $optionsList[] = [
                                        'id' => $option->id,
                                        'name' => $option->lang($lang)->name,
                                        'icon' => ($option->icon) ? $option->icon->getThumb(24, 24) : null
                                    ];
                                }

                            if ($product->entrees_cat and count($product->entrees_cat))
                                foreach ($product->entrees_cat as $entrees) {
                                    $listDetail = null;
                                    $dataList = $product->getEntreesList($entrees->id);
                                    if ($dataList and count($dataList))
                                        foreach ($dataList as $row) {
                                            $listDetail[] = [
                                                "id" => $row->id,
                                                "cat_id" => $row->cat_id,
                                                "type" => "entrees",
                                                "title" => $row->lang($lang)->name,
                                                "description" => $row->text,
                                                "price" => $row->price,
                                                "image" => ($row->image) ? $row->image->getPath() : null,
                                                "thumb" => ($row->image) ? $row->image->getThumb(200, 200) : null,
                                            ];
                                        }
                                    $entreesList[] = [
                                        'id' => $entrees->id,
                                        'name' => $entrees->lang($lang)->name,
                                        'icon' => ($entrees->icon) ? $entrees->icon->getThumb(50, 50) : null,
                                        'list' => $listDetail
                                    ];
                                }

                            if ($product->allergy and count($product->allergy))
                                foreach ($product->allergy as $allergy) {
                                    $allergyList[] = [
                                        'name' => $allergy->lang($lang)->name,
                                        'code' => $allergy->code,
                                        'icon' => ($allergy->icon) ? $allergy->icon->getThumb(24, 24) : null
                                    ];
                                }

                            $productsSupList[] = [
                                "id" => $product->id,
                                "cat_id" => $product->cat_id,
                                "min_person" => $product->min_person,
                                "type" => "food",
                                "special" => $product->special,
                                "title" => $product->lang($lang)->title,
                                "note" => $product->lang($lang)->note,
                                "description" => $product->desc,
                                "alert_person" => $product->alert_person ? $product->alert_person : null,
                                "price" => (isset($product->view_price['val'])) ? $product->view_price['val'] : null,
                                "price_option" => $product->price_option,
                                "spicy_option" => $product->spicy_option,
                                "is_sous" => $product->is_sous,
                                "is_tilbehor" => $product->is_tilbehor,
                                "options" => $optionsList,
                                "entrees_cat" => $entreesList,
                                "allergy" => $allergyList,
                                "image" => ($product->image) ? $product->image->getPath() : null,
                                "thumb" => ($product->image) ? $product->image->getThumb(200, 200) : null,
                            ];
                        }

                        $supCategory[] = [
                            "id" => $item->id,
                            "type" => "food",
                            "name" => $item->name,
                            "top_note" => $item->lang($lang)->top_note,
                            "down_note" => $item->lang($lang)->down_note,
                            "products" => $productsSupList,
                        ];
                    }

                $jsonData = [
                    "name" => $data->lang($lang)->name,
                    "top_note" => $data->lang($lang)->top_note,
                    "down_note" => $data->lang($lang)->down_note,
                    "image" => $data->image,
                    "products" => $productsList,
                    "sup_category" => $supCategory
                ];
            endif;
        } elseif ($type == "entrees") {
            $data = EntreesCat::find($id);
            if ($data):
                $productsList = null;
                $products = $data->entreesList;
                foreach ($products as $product) {
                    $productsList[] = [
                        "id" => $product->id,
                        "cat_id" => $product->cat_id,
                        "type" => "entrees",
                        "special" => null,
                        "title" => $product->lang($lang)->name,
                        "note" => null,
                        "description" => ($product->text) ? $product->text : null,
                        "price" => $product->price,
                        "price_option" => null,
                        "spicy_option" => null,
                        "options" => null,
                        "entrees_cat" => null,
                        "allergy" => null,
                        "image" => ($product->image) ? $product->image->getPath() : null,
                        "thumb" => ($product->image) ? $product->image->getThumb(200, 200) : null,
                    ];
                }

                $jsonData = [
                    "name" => $data->lang($lang)->name,
                    "top_note" => $data->lang($lang)->note,
                    "down_note" => null,
                    "image" => $data->icon,
                    "products" => $productsList
                ];

            endif;
        }

        return response()->json($jsonData);
    }

    public function food($id)
    {
        $jsonData = null;
        $product = Foods::find($id);
        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';
        if ($product):

            $optionsList = null;
            $entreesList = null;
            $allergyList = null;
            if ($product->options and count($product->options))
                foreach ($product->options as $option) {
                    $optionsList[] = [
                        'id' => $option->id,
                        'name' => $option->lang($lang)->name,
                        'icon' => ($option->icon) ? $option->icon->getThumb(24, 24) : null
                    ];
                }

            if ($product->entrees_cat and count($product->entrees_cat))
                foreach ($product->entrees_cat as $entrees) {
                    $listDetail = null;
                    $dataList = $product->getEntreesList($entrees->id);
                    if ($dataList and count($dataList))
                        foreach ($dataList as $row) {
                            $listDetail[] = [
                                "id" => $row->id,
                                "cat_id" => $row->cat_id,
                                "type" => "entrees",
                                "title" => $row->lang($lang)->name,
                                "description" => $row->text,
                                "price" => $row->price,
                                "image" => ($row->image) ? $row->image->getPath() : null,
                                "thumb" => ($row->image) ? $row->image->getThumb(200, 200) : null,
                            ];
                        }

                    $entreesList[] = [
                        'id' => $entrees->id,
                        'name' => $entrees->lang($lang)->name,
                        'icon' => ($entrees->icon) ? $entrees->icon->getThumb(50, 50) : null,
                        'list' => $listDetail
                    ];
                }

            if ($product->allergy and count($product->allergy))
                foreach ($product->allergy as $allergy) {
                    $allergyList[] = [
                        'name' => $allergy->lang($lang)->name,
                        'code' => $allergy->code,
                        'icon' => ($allergy->icon) ? $allergy->icon->getThumb(24, 24) : null
                    ];
                }

            $jsonData[] = [
                "id" => $product->id,
                "cat_id" => $product->cat_id,
                "type" => "food",
                "special" => $product->special,
                "title" => $product->lang($lang)->title,
                "note" => $product->lang($lang)->note,
                "description" => $product->desc,
                "price" => (isset($product->view_price['val'])) ? $product->view_price['val'] : null,
                "price_option" => $product->price_option,
                "options" => $optionsList,
                "entrees_cat" => $entreesList,
                "allergy" => $allergyList,
                "image" => ($product->image) ? $product->image->getPath() : null,
                "thumb" => ($product->image) ? $product->image->getThumb(200, 200) : null,
            ];
        endif;

        return response()->json($jsonData);
    }

    public function entrees()
    {

        $products = Categories::where('is_exstra',1)->first();
        $data = array();
        foreach ($products->foodList as $product){
            $data[] = [
                "id" => $product->id,
                "cat_id" => $product->cat_id,
                "type" => "food",
                "special" => $product->special,
                "title" => $product->title,
                "note" => $product->note,
                "description" => $product->desc,
                "price" => (isset($product->view_price['val'])) ? $product->view_price['val'] : null,
                "price_option" => $product->price_option,
                "image" => ($product->image) ? $product->image->getPath() : null,
                "thumb" => ($product->image) ? $product->image->getThumb(200, 200) : null,
            ];
        }
        return response()->json($data);
    }

}