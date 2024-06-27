<?php namespace Coolnet\Cart\Classes;

use Coolnet\Cart\Models\CartData;
use Auth;
use JWTAuth;
class CoolNetCart
{
	protected $group_id;
	protected $user_id;
	protected $tax_rate = 0;
	protected $cartData = null;

    public function __construct( $group_id = 'shopcart') {

        if (!Auth::getUser() && !JWTAuth::getToken())
            return null;
        $user = Auth::getUser() ? $user = Auth::getUser() : $this->getAuthenticatedUser();
        $this->user_id  = $user->id;
        $this->group_id = $group_id;
        $this->cartData = $this->getCart();
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
    public function getItems()
    {
		return $this->cartData->itemsList;
    }

	public function count()
	{
		if($this->cartData)
		return $this->cartData->itemsList()->sum('quantity');
	}


	public function counts()
	{
		if($this->cartData)
		return $this->cartData->itemsList()->count();
	}

    public function sub_total()
    {
		if($this->cartData)
    	return $this->cartData->sub_total;
    }
    public function sub_total_round()
    {
		if($this->cartData)
    	return $this->cartData->sub_total_round;
    }
    public function sub_total_number()
    {
		if($this->cartData)
    	return $this->cartData->sub_total_number;
    }

    public function total()
    {
		if($this->cartData)
    	return $this->cartData->total;
    }
    public function total_round()
    {
		if($this->cartData)
    	return $this->cartData->total_round;
    }
    public function total_number()
    {
		if($this->cartData)
    	return $this->cartData->total_number;
    }

    public function grand_total()
    {
		if($this->cartData)
    	return $this->cartData->grand_total;
    }
    public function grand_total_round()
    {
		if($this->cartData)
    	return $this->cartData->grand_total_round;
    }
    public function grand_total_number()
    {
		if($this->cartData)
    	return $this->cartData->grand_total_number;
    }

    public function discount_total()
    {
		if($this->cartData)
    	return $this->cartData->discount_total;
    }
    public function discount_total_round()
    {
		if($this->cartData)
    	return $this->cartData->discount_total_round;
    }
    public function discount_total_number()
    {
		if($this->cartData)
    	return $this->cartData->discount_total_number;
    }

    public function tax_total()
    {
		if($this->cartData)
    	return $this->cartData->tax_total;
    }

    public function coupon_number(){
        $coupon = Coupons::find($this->cartData->coupon_id);
        if ($coupon)
            return $this->cartData->total_number * $coupon->coupon_rate/100;
        else
            return 0;
    }
    public function tax_total_round()
    {
		if($this->cartData)
    	return $this->cartData->tax_total_round;
    }
    public function tax_total_number()
    {
		if($this->cartData)
    	return $this->cartData->tax_total_number;
    }

	public function tpms_total()
    {
		if($this->cartData)
    	return $this->cartData->tpms_total;
    }
    public function tpms_total_round()
    {
		if($this->cartData)
    	return $this->cartData->tpms_total_round;
    }
    public function tpms_total_number()
    {
		if($this->cartData)
    	return $this->cartData->tpms_total_number;
    }

	public function tpms_price()
    {
		if($this->cartData)
    	return $this->cartData->tpms_price;
    }
    public function tpms_price_round()
    {
		if($this->cartData)
    	return $this->cartData->tpms_price_round;
    }
    public function tpms_price_number()
    {
		if($this->cartData)
    	return $this->cartData->tpms_price_number;
    }


	public function setTpmsCount($count,$price)
	{
		$this->cartData->tpms_count = $count;
		$this->cartData->tmps_price = $price;
		$this->cartData->tpms_total = $count * $price;
		$this->cartData->save();
	}

	public function setPromo($promo_id)
	{
		$this->cartData->coupon_id = $promo_id;
		$this->cartData->save();
	}

    public function cart_detail(){
	    return CartData::where('user_id', $this->user_id)->where('group_id',$this->group_id)->first();
    }
	public function setShipping($shipping,$delivery)
	{
		$this->cartData->shipping = $shipping;
		$this->cartData->delivery_id = $delivery;
		$this->cartData->save();
	}


	// add item to cart
	public function add( $productId ,
						 $quantity ,
						 $price ,
						 $options = null ,
						 $attr = [ 'tax_rate' => 0, 'tax' => 0, 'discount_rate' => 0 , 'discount' => 0 , 'type' => 'product' ] )
	{

		$productId = (int) $productId;
        $quantity = (int) $quantity;
		if($productId > 0 && $quantity > 0  )
		{
			$type = isset($attr['type']) ? $attr['type'] : 'product';

			$itemId = $this->generateItemId($productId, $options, $type );
			$item = $this->hasItemId($itemId);
			if($item)
			{
				$this->updateItem($item,$item->quantity + $quantity);
			}
			else
			{
				$tax_rate = isset($attr['tax_rate']) ? $attr['tax_rate'] : 0;
				$tax_amount = isset($attr['tax']) ? $attr['tax'] : 0;
				$tax_total = $this->getItemTax($quantity,$price,$tax_rate,$tax_amount);

				$discount_rate = isset($attr['discount_rate']) ? $attr['discount_rate'] : 0;
				$discount_amount = isset($attr['discount']) ? $attr['discount'] : 0;
				$discount_total = $this->getItemDiscount($quantity,$price,$discount_rate,$discount_amount);

				$this->cartData->itemsList()->create([
					'product_id' 		=> $productId,
					'item_id' 		    => $itemId,
					'quantity'   		=> $quantity,
					'price'      		=> $price,
					'tax_rate'   		=> $tax_rate,
					'tax_amount' 		=> $tax_amount,
					'tax_total'     	=> $tax_total,
					'discount_rate' 	=> $discount_rate,
					'discount_amount'	=> $discount_amount,
					'discount_total'    => $discount_total,
					'item_total'        => ($quantity * $price) - $discount_total + $tax_total,
					'type' 				=> isset($attr['type']) ? $attr['type'] : 'product',
					'options'			=> $options
				]);

				$this->setCartTotals();
			}

		}
	}

	public function update( $itemId, $quantity = null , $price = null ,  $attr = null )
	{
			$item = $this->cartData->itemsList()->where('item_id',$itemId)->first();
			$this->updateItem($item,$quantity,$price,$attr);
	}

	public function remove($itemId)
	{
		$this->cartData->itemsList()->where('item_id',$itemId)->delete();
		$this->setCartTotals();
	}


	public function clear()
	{
		$this->cartData->itemsList()->delete();
		$this->setCartTotals();
	}

	protected function setSubTotal()
	{
		$this->cartData->sub_total = $cart->itemsList()->sum('item_total');
		$this->cartData->save();
	}

	protected function getItemTax($quantity,$price,$tax_rate,$tax_amount)
	{
		$itemTotal = $quantity*$price;
		$tax_rate = ($tax_rate > 1)? $tax_rate/100:$tax_rate;

		return ($itemTotal*$tax_rate) + ($quantity*$tax_amount);
	}

	protected function getItemDiscount($quantity,$price,$discount_rate,$discount_amount)
	{
		$itemTotal = $quantity*$price;
		$discount_rate = ($discount_rate > 1)? $discount_rate/100:$discount_rate;

		return ($itemTotal*$discount_rate) + ($quantity*$discount_amount);
	}

	protected function getDiscountTotal(){
		if($this->cartData->discount_rate)
		{
			$discount_rate = ($this->cartData->discount_rate > 1)? $this->cartData->discount_rate/100:$this->cartData->discount_rate;
			return $this->cartData->total * $discount_rate;
		}
		elseif($this->cartData->discount_amount)
			return $this->cartData->discount_amount;

		return $this->cartData->itemsList()->sum('discount_total');

	}


	protected function getTaxTotal(){
		if($this->cartData->tax_rate)
		{
			$tax_rate = ($this->cartData->tax_rate > 1)? $this->cartData->tax_rate/100:$this->cartData->tax_rate;
			return $this->cartData->total * $tax_rate;
		}
		elseif($this->cartData->tax_amount)
			return $this->cartData->tax_amount;

		return $this->cartData->itemsList()->sum('tax_total');

	}

	protected function setCartTotals()
	{
		if($this->cartData->itemsList()->count() == 0 )
			$this->resetCart();

		$this->cartData->sub_total 		= $this->getCart()->itemsList()->sum('item_total');
		$this->cartData->total 			= $this->cartData->shipping + $this->cartData->sub_total;

		$this->cartData->discount_total = $this->getDiscountTotal();
		$this->cartData->tax_total 		= $this->getTaxTotal();

		if($this->cartData->discount_rate || $this->cartData->discount_amount)
			$this->cartData->grand_total 	= $this->cartData->total - $this->cartData->discount_total + $this->cartData->tax_total;
		else
			$this->cartData->grand_total 	= $this->cartData->total + $this->cartData->tax_total;

		$this->cartData->save();
	}


	protected function resetCart()
	{
		$this->cartData->shipping 		= 0;
		$this->cartData->promo 			= 0;
		$this->cartData->discount_rate 	= 0;
		$this->cartData->discount_amount	= 0;
		$this->cartData->discount_total 	= 0;
		$this->cartData->tax_rate 		= $this->tax_rate;
		$this->cartData->tax_amount 		= 0;
		$this->cartData->tax_total 		= 0;
		$this->cartData->sub_total 		= 0;
		$this->cartData->total 			= 0;
		$this->cartData->grand_total 		= 0;
		$this->cartData->coupon_id 		= 0;
		$this->cartData->delivery_id 		= 0;
		$this->cartData->address_id 		= 0;
		$this->cartData->data_version 		= 0;
		$this->cartData->payment_method = null;
		$this->cartData->delivery_method = null;
		$this->cartData->save();
	}

	protected function updateItem( $item, $quantity = null, $price = null , $attr = null)
	{
		if($quantity) $item->quantity = $quantity;

		if($price) $item->price = $price;
		if(isset($attr['tax_rate']))  $item->tax_rate = $attr['tax_rate'];
		if(isset($attr['tax']))  $item->tax_amount = $attr['tax'];
		if(isset($attr['discount_rate']))  $item->tax_rate = $attr['discount_rate'];
		if(isset($attr['discount']))  $item->discount_amount = $attr['discount'];


		$item->tax_total = $this->getItemTax($item->quantity,$item->price,$item->tax_rate,$item->tax_amount);
		$item->discount_total = $this->getItemDiscount($item->quantity,$item->price,$item->discount_rate,$item->discount_amount);
		$item->item_total = ($item->quantity * $item->price) - $item->discount_total + $item->tax_total ;

		$item->save();

		$this->setCartTotals();
	}

	protected function getCart()
	{
		$cart = CartData::where('user_id', $this->user_id)->where('group_id',$this->group_id)->first();
		if($cart)
			return $cart;
		return $this->createCart();
	}

	// create a new cart record in the database
	protected function createCart()
	{
		$cart = new CartData;
		$cart->user_id = $this->user_id;
		$cart->group_id = $this->group_id;
		$cart->tax_rate = $this->tax_rate;
		$cart->save();
		return $cart;
	}

	// generate unique item code for product
	protected function generateItemId($productId, $options,$type='')
    {
        ksort($options);
        return md5($productId . serialize($options).$type);
    }

    protected function hasItemId($itemId)
    {
        return $this->cartData->itemsList()->where('item_id',$itemId)->first();
    }

}
