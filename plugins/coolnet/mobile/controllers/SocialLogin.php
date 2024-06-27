<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller; 
use RainLab\User\Models\User; 
use Input;

use Flynsarmy\SocialLogin\Models\Settings;
use \Tymon\JWTAuth\Facades\JWTAuth;

class SocialLogin extends Controller
{  
    public function __construct($theme = null)
    {   
        parent::__construct($theme);  
    }

    public function settingData()
    {
    	$data = Settings::where('item','flynsarmy_sociallogin_settings')->first(); 

    	return response()->json(['data' => $data->providers]);
    }

    public function facebook()
    {    
          
        $userModel = User::findByEmail(Input::get('email'));
  

        if ($userModel->methodExists('getAuthApiSigninAttributes')) {
            $user = $userModel->getAuthApiSigninAttributes();
        } else {
            $user = [
                'id' => $userModel->id,
                'name' => $userModel->name,
                'surname' => $userModel->surname,
                'username' => $userModel->username,
                'email' => $userModel->email,
                'is_activated' => $userModel->is_activated,
            ];
        }

        $token = JWTAuth::fromUser($userModel);

        return response()->json(compact('token', 'user'));
    }
 
}