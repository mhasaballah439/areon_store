<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Products\Models\Categories;
use Coolnet\Products\Models\Products;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Models\Message;
use Input;

class ProductsData extends Controller
{
    public function __construct($theme = null)
    {
        parent::__construct($theme);
    }

    public function getCategoriesIndex()
    {
        $categories = Categories::Active()->where('parent_id', 0)->where('is_home', 1)->take(3)->get();
        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';
        $catList = [];
        foreach ($categories as $category) {
            $sub_cat = [];
            if ($category->children) {
                foreach ($category->children as $child) {
                    $sub_cat[] = [
                        'id' => $child->id,
                        'name' => $child->lang($lang)->name,
                        'image' => isset($child->image) ? $child->image->getPath() : []
                    ];
                }
            }
            $catList[] = [
                'id' => $category->id,
                'name' => $category->lang($lang)->name,
                'image' => isset($category->image) ? $category->image->getPath() : [],
                'sub_category' => $sub_cat ? $sub_cat : null
            ];
        }

        return response()->json($catList);
    }

    public function getProductsCategory()
    {
        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';
        $category = Categories::Active()->where('id', Input::get('cat_id'))->first();
        $catList = [];
        $childrenList = [];
        if ($category) {
            if ($category->children) {
                foreach ($category->children as $child) {
                    $productList = [];
                    if ($child->products){
                        foreach ($child->products as $product) {
                            $images = [];

                            if ($product->images){
                                foreach ($product->images as $image) {
                                    $images[] = [
                                        'image' => $image->getPath()
                                    ];
                                }
                            }
                            $productList[] = [
                              'id' => $product->id,
                              'short_title' => $product->short_title,
                                'price' => $product->price_product,
                                'category' => isset($product->category) ? $product->category->lang($lang)->name : null,
                                'images' => $images ? $images : [],
                            ];
                        }
                    }
                    $childrenList[] = [
                        'child' => $child->lang($lang)->name,
                        'productList' => $productList ? $productList : null,
                    ];
                }
            }
            $catList[] = [
                'name' => $category->lang($lang)->name,
                'children' => $childrenList ? $childrenList : null
            ];

            return response()->json($catList);
        }else{
            return response()->json(['msg' =>'data can not found'],301);
        }
    }


    public function getAllCategories(){
        $categories = Categories::Active()->where('parent_id', 0)->get();
        $lang = (Input::get('lang')) ? Input::get('lang') : 'no';
        $catList = [];
        foreach ($categories as $category) {
            $sub_cat = [];
            if ($category->children) {
                foreach ($category->children as $child) {
                    $sub_cat[] = [
                        'id' => $child->id,
                        'name' => $child->lang($lang)->name,
                        'image' => isset($child->image) ? $child->image->getPath() : null
                    ];
                }
            }
            $catList[] = [
                'id' => $category->id,
                'name' => $category->lang($lang)->name,
                'sub_category' => $sub_cat ? $sub_cat : null
            ];
        }

        return response()->json($catList);
    }

    public function getProductDetail(){
        $product = Products::Active()->where('id',Input::get('id'))->first();
        $dataList = [];
        $images = [];

        if ($product->images){
            foreach ($product->images as $image) {
                $images[] = [
                    'image' => $image->getPath()
                ];
            }
        }
        $dataList[] = [
            'id' => $product->id,
            'short_title' => $product->short_title,
            'title' => $product->title,
            'desc' => strip_tags($product->desc),
            'price' => $product->price_product,
            'category' => isset($product->category) ? $product->category->name : null,
            'details' => $product->details ? $product->details : null,
            'images' => $images ? $images : null,
        ];

        return response()->json($dataList);
    }

    public function searchProducts(){
        $products = Products::where('title','LIKE','%'.Input::get('search').'%')
            ->orWhere('desc','LIKE','%'.Input::get('search').'%')->get();
        $dataList = [];
        if ($products)
            foreach ($products as $product) {
                $images = [];
                if ($product->images) {
                    foreach ($product->images as $image) {
                        $images[] = [
                            'image' => $image->getPath()
                        ];
                    }
                }
                $dataList[] = [
                    'id' => $product->id,
                    'short_title' => $product->short_title,
                    'title' => $product->title,
                    'desc' => strip_tags($product->desc),
                    'price' => $product->price_product,
                    'category' => isset($product->category) ? $product->category->name : null,
                    'details' => $product->details ? $product->details : null,
                    'images' => $images ? $images : null,
                ];
            }

        return response()->json($dataList);
    }
}
