<?php namespace Coolnet\Profile;

use System\Classes\PluginBase;
use RainLab\User\Models\User as UsersModel;
use RainLab\User\Controllers\Users as UserController;
class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Coolnet\Profile\Components\AddressData' => 'user_address'
        ];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        UsersModel::extend(function ($model) {
            $model->addFillable([
                'mobile', 'company_number','company_name','user_role'
                ]);
        });
        UserController::extendFormFields(function ($form, $model, $context) {
            $form->addTabFields([
                'mobile' => [
                    'label' => 'Mobile',
                    'type' => 'text',
                    'span' => 'auto',
                    'tab' => 'profile',
                ],
                'company_number' => [
                    'label' => 'Company number',
                    'type' => 'text',
                    'span' => 'auto',
                    'tab' => 'profile',
                ],
                'company_name' => [
                    'label' => 'Company name',
                    'type' => 'text',
                    'span' => 'auto',
                    'tab' => 'profile',
                ]
            ]);
        });
    }

}
