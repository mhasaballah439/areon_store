<?php

use Renatio\DynamicPDF\Classes\PDF;
use Coolnet\Orders\Models\Orders;

Route::get('/printOrder/{id}/{code}',function ($id,$code){
    $order = Orders::where('id',$id)->where('code',$code)->first();
    return PDF::loadTemplate('print-order',["order" => $order])->stream('order.pdf');
});
