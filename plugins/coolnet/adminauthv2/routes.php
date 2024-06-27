<?php

use Backend\Models\AccessLog;
use Backend\Models\User;
use Backend\Classes\Controller;
use System\Classes\UpdateManager;
Route::group(['namespace' => 'Coolnet\adminauthv2\Controllers','prefix'=>'api_v2'],function (){
    Route::post('/send-notify','Notify@sendNotify');
});
