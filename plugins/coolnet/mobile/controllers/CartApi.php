<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use Coolnet\Cart\Classes\CoolNetCart;
use Coolnet\Cart\Models\Cart;

use Coolnet\Cart\Models\CartData;
use Coolnet\Cart\Models\CartInfo;

use Coolnet\Cart\Models\CartItem;
use Coolnet\Menu\Models\Categories;
use Coolnet\Menu\Models\Coupons;
use Coolnet\Menu\Models\Foods;
use Coolnet\Menu\Models\Entrees;
use Coolnet\Menu\Models\EntreesCat;
use Coolnet\Menu\Models\Orders;
use Coolnet\Menu\Models\Address;
use Coolnet\Menu\Models\Setting;
use Coolnet\Menu\Models\Delivery;

use Coolnet\Menu\Models\Times;
use Coolnet\Products\Models\Products;
use Illuminate\Support\Facades\Session;
use Input;
use JWTAuth;
use Db;
use Auth;
use RainLab\User\Models\User as UsersModel;

class CartApi extends Controller
{
    var $user;

    public function __construct($theme = null)
    {
        parent::__construct($theme);
        $this->user = $this->getAuthenticatedUser();
    }


    public function cartData()
    {
        if ($this->user) {
            $cart = CartData::where('user_id', $this->user->id)->first();
            $cartList = [];
            $productsList = [];
            if (isset($cart->itemsList) && count($cart->itemsList) > 0) {
                foreach ($cart->itemsList as $list) {
                    $productsList[] = [
                        'id' => $list->id,
                        'product_id' => $list->product_id,
                        'name' => isset($list->product) ? $list->product->short_title : null,
                        'cart_id' => $list->cart_id,
                        'price' => $list->price ? $list->price : 0,
                        'quantity' => $list->quantity ? $list->quantity : 0,
                        'tax_rate' => $list->tax_rate ? $list->tax_rate : 0,
                        'discount_rate' => $list->discount_rate ? $list->discount_rate : 0,
                        'item_id' => $list->item_id,
                        'options' => $list->options,
                        'type' => $list->type,
                        'image' => isset($list->product) ? $list->product->images[0]->getPath() : null,
                    ];
                }
                $cartList[] = [
                    'id' => $cart->id,
                    'user_id' => $cart->user_id,
                    'shipping' => $cart->shipping,
                    'discount_rate' => $cart->discount_rate,
                    'tax_rate' => $cart->tax_rate,
                    'delivery_id' => $cart->delivery_id,
                    'address_id' => $cart->address_id,
                    'tax_total' => $cart->tax_total_number,
                    'sub_total' => $cart->sub_total_number,
                    'total' => $cart->total_number,
                    'discount_total' => $cart->discount_total_number,
                    'coupon_total' => number_format($cart->coupon_total, 2),
                    'count_products' => $cart->itemsList->count(),
                    'products' => $productsList ? $productsList : null,
                ];
                return response()->json($cartList);
            }else{
                return response()->json(['msg' => 'cart is empty']);
            }

        } else {
            return response()->json(['msg' => 'user not found'], 301);
        }

    }

    public function addCart()
    {
        if ($this->user) {
            $cart = new CoolNetCart('shopcart');
            $cartData = CartData::where('user_id', $this->user->id)->first();
            $productData = Products::find(post('product_id'));
            if (!$productData) {
                return response()->json(['msg' => 'Error product not found']);
            }

            $productId = $productData->id;
            $quantity = post('quantity');
            $price = $productData->price_product;

            $options = [
                'id' => $productData->id,
                'title' => $productData->title,
                'price' => $productData->price_product,
            ];
            $cartData->data_version = $cartData->data_version+1;
            $cartData->save();

            $cart->add($productId, $quantity, $price, $options);
            return $this->cartData();
        }
    }

    public function updateCart()
    {
        if ($this->user) {
            $cart = new CoolNetCart('shopcart');
            $cartItem = CartItem::where('item_id',post('item_id'))->first();
            if (!$cartItem)
                return response()->json(['msg' => 'Item not found']);

                $cart->update(post('item_id'), post('quantity'));
            return $this->cartData();
        }
    }

    public function removeCart()
    {
        if ($this->user) {
            $cart = new CoolNetCart('shopcart');
            $cartItem = CartItem::where('item_id',post('item_id'))->first();
            if (!$cartItem)
                return response()->json(['msg' => 'Item not found']);

            $cart->remove(post('item_id'));
            return $this->cartData();
        }
    }

    public function clearCart()
    {
        if ($this->user) {
            $cart = new CoolNetCart('shopcart');

            $cart->clear();

            return $this->cartData();
        }
    }

    protected function getAuthenticatedUser()
    {
        $user = NULL;
        if (JWTAuth::getToken())
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return false;
            }
        return $user;
    }
}
