<?php

namespace Coolnet\Mobile\Controllers;

use Cms\Classes\Controller;
use RainLab\User\Models\User;
use Input;
use Mail;
use Illuminate\Http\Response;

class ChangePasswordApi  extends Controller
{


    public function ForgotPassword()
    {
        $email = Input::get('email');

        $user = User::findByEmail($email);
        if (!$user || $user->isBanned() ) {
            return response()->json(
                ['error' => 'user_not_found'],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($user)
            $this->sendResetPasswordEmail($user);

        return response()->json(['status' => 200,'msg' => 'email send success'],200);
    }



    /**
     * Reset the user password
     *
     * @param ResetPasswordRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function ResetPassword()
    {
        $code = Input::get('reset_password_code');
        $parts = explode('!', $code);

        // @TODO Can I convert it as validator?
        if (count($parts) != 2) {
            return response()->json(
                ['error' => 'invalid_reset_password_code'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        list($userId, $code) = $parts;

        // @TODO Can I convert it as validator?
        if (!strlen(trim($userId)) || !($user = User::find($userId))) {
            return response()->json(
                ['error' => 'invalid_user'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!$user->attemptResetPassword($code, Input::get('password'))) {
            return response()->json(
                ['error' => 'invalid_reset_password_code'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return response()->json([]);
    }
////////////////////////////////////////////////////////////////////
    /**
     * Sends the forgot password email to a user
     *
     * @param User $user
     * @return void
     */
    protected function sendResetPasswordEmail(User $user)
    {
        $code = implode('!', [$user->id, $user->getResetPasswordCode()]);
        $link = $this->makeResetPasswordUrl($code);

        $data = [
            'name' => $user->name,
            'link' => $link,
            'code' => $code
        ];

         Mail::send('rainlab.user::mail.restore', $data, function($message) use ($user) {
            $message->to($user->email, $user->full_name);
        });
    }

    /**
     * Create the password reset URL
     *
     * @param string $code
     * @return string
     */
    protected function makeResetPasswordUrl($code)
    {
       return "http://amberrestaurant.no/forgot-password/".$code;//Settings::get('reset_password_url');

    }



}
