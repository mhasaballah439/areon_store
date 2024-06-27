<?php

Route::group(['namespace' => 'Coolnet\Mobile\Controllers','prefix' => 'api'],function (){
    Route::get('/sliders','Sliders@index');
    Route::get('/setting','WebSetting@index');
    Route::get('/categories-home','ProductsData@getCategoriesIndex');
    Route::post('/category-products','ProductsData@getProductsCategory');
    Route::post('/search-products','ProductsData@searchProducts');
    Route::get('/all-categories','ProductsData@getAllCategories');
    Route::post('/product-detail','ProductsData@getProductDetail');
    Route::get('/text-pages','Data@getTextPages');
    Route::post('/detail-text-pages','Data@getPageDetail');

    Route::post('/change-password','ChangePasswordApi@ForgotPassword');
    Route::post('/reset-password','ChangePasswordApi@ResetPassword');

});

Route::group(['middleware' => '\Tymon\JWTAuth\Middleware\GetUserFromToken','prefix' => 'api',
    'namespace' => 'Coolnet\Mobile\Controllers'], function() {

	//////////////////////////Profile API ////////////////////////////

    Route::get('/user-profile','ProfileApi@myProfile');
    Route::post('/update_profile','ProfileApi@updateProfile');
	Route::post('/deactivate','ProfileApi@deactivate');
	Route::get('/orders','ProfileApi@userOrders');

    Route::get('/addressList','ProfileApi@myAddress');
	Route::post('/addAddress','ProfileApi@addAddress');
	Route::post('/deleteAddress','ProfileApi@deleteAddress');
	Route::post('/logout','ProfileApi@logout');


	/////////////////////// Cart API /////////////////////////////
    Route::get('/cart','CartApi@cartData');
    Route::post('/add-cart','CartApi@addCart');
    Route::post('/update-cart','CartApi@updateCart');
    Route::post('/remove-cart','CartApi@removeCart');
    Route::post('/clear-cart','CartApi@clearCart');
    Route::post('/select-delivery-method','CartApi@selectDeliveryMethod');
    Route::post('/user-delivery-method','CartApi@getDeleviryUser');

    ################## order ####################
	Route::post('/createOrder','OrdersApi@createOrder');
	Route::post('/getOrder','OrdersApi@getOrder');

	Route::post('/cardToken','OrdersApi@cardToken');
	Route::post('/listCard','OrdersApi@listCard');
    Route::post('/deleteCard','OrdersApi@deleteCard');
});






