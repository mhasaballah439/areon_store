<?php namespace Coolnet\adminauthv2\Classes;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Messaging;
class CoolNetNotify
{

    public function __construct()
    {
        $this->factory = (new Factory())->withServiceAccount(__DIR__ . '/areon-c920e-firebase-adminsdk-d48r7-18175532cc.json');
//        ->withProjectId('1073712181640');

    }

    public function sendNotify($order){
        $notification = [
            "title" => "New Order",
            "body" => "#".$order->code." Total: ".$order->total."Kr"
        ];

        $data =[ ];

        $this->to_topic('all',$notification,$data);

        return response()->json(['msg' => 'successfully send']);
    }

    public function sendCartUpdateNotify(){
        $notification = [
            "title" => "New update to cart",
        ];

        $data =[ ];

        $this->to_topic('all',$notification,$data);

        return response()->json(['msg' => 'successfully send']);
    }

    public function to_topic($topic,$notification,$data)
    {
        $this->factory->createAuth();
        $messaging = $this->factory->createMessaging();
        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => $notification, // optional
            'data' => $data, // optional
        ]);

        $sendReport = $messaging->send($message);

        return $sendReport;

    }
}
