<?php

namespace Coolnet\adminauthv2\Controllers;


use Cms\Classes\Controller;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Messaging;
use Coolnet\adminauthv2\Classes\CoolNetNotify;
class Notify extends Controller
{

    public function sendCartUpdateNotify(){
        $n = new CoolNetNotify();
        $n->sendCartUpdateNotify();
    }

     public function  sendMessage($topic,$notification,$data){
        $content = array(
            "en" => $notification
            );

        $fields = array(
            'app_id' => "b32c75f2-9499-4cab-9863-63d11c4af96f",
            'included_segments' => array($topic),
            'data' => $data,
            'contents' => $content
        );

        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
        //print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic MDNiMWYzMmEtZGRmOS00ZGNiLWExOWEtYzY1OThkODQ4N2Fl'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        //dd($response);
        return $response;

    }




}
