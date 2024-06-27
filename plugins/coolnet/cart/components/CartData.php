<?php namespace Coolnet\Cart\Components;

use Cms\Classes\ComponentBase;

use Coolnet\adminauthv2\Classes\CoolNetNotify;
use Coolnet\Cart\Classes\CoolNetCart;
use Auth;
use Coolnet\Products\Models\Products;
use October\Rain\Support\Facades\Flash;
use October\Rain\Support\Facades\Input;
use Coolnet\Cart\Models\CartData as DataCart;
use Redirect;

class CartData extends ComponentBase
{

    public $group_id = 'shopcart';


    public function componentDetails()
    {

        return [
            'name' => 'Cart',
            'description' => 'Return all cart'
        ];

    }

    public function onRun()
    {
        $cart = new CoolNetCart($this->group_id);
        $this->cartData = $this->page['cartData'] = $cart;
        $this->cartDetail = $this->page['cartDetail'] = $this->getCartData();
    }

    public function onAddCart()
    {
        if (Auth::check()) {
            $cart = new CoolNetCart($this->group_id);
            $notify = new CoolNetNotify();
            $productData = Products::find(post('product_id'));
            if (!$productData) Flash::error('Error product not found');

            $productId = $productData->id;
            $quantity = post('quantity');
            $price = $productData->price_product;
            $options = [
                'id' => $productData->id,
                'title' => $productData->title,
                'price' => $productData->price_product,
                'note' => Input::get('note') ? Input::get('note') : null,
            ];

            $cart->add($productId, $quantity, $price, $options);
            $notify->sendNotify();
        }else{
            return redirect('/login');
        }
    }

    public function onUpdateCart()
    {
        $cart = new CoolNetCart($this->group_id);

        $cart->update(post('item_id'), post('quantity'));

    }

    public function onRemoveCart()
    {
        $cartData = new CoolNetCart($this->group_id);

        $cart = new CoolNetCart($this->group_id);

        $cart->remove(post('item_id'));

        if ($cartData->count() == 0)
            return Redirect::to('/cart');

        Flash::success('Product remove successfully saved!');
    }

    public function onClearCart()
    {
        $cart = new CoolNetCart($this->group_id);

        $cart->clear();

        Flash::success('Cart clear successfully saved!');
    }

    public function onSelectAddress()
    {
        if (Auth::check()) {
        $cart = DataCart::where('user_id', Auth::getUser()->id)->first();
        $cart->address_id = Input::get('id');
        $cart->save();
        Flash::success('Address Selected');
        }else{
            return redirect('/login');
        }
    }

    public function onSelectDeliveryMethod()
    {
        if (Auth::check()) {
        $cart = DataCart::where('user_id', Auth::getUser()->id)->first();
        if (Input::get('delivery_method') == 'cash') {
            $cart->delivery_method = 'cash';
            $cart->address_id = 0;
        } else {
            $cart->delivery_method = 'delivery';
        }
        $cart->save();
        }else{
            return redirect('/login');
        }
    }

    public function onCartChange(){
        if (Auth::check()) {
        $cart = DataCart::where('user_id', Auth::getUser()->id)->first();
        if (post('data_version') != $cart->data_version)
            return redirect('/cart');
        }else{
            return redirect('/login');
        }
    }

    public function getCartData(){
        if(Auth::check())
            return DataCart::where('user_id', Auth::getUser()->id)->first();
        else
            return redirect('/login');
    }
}
