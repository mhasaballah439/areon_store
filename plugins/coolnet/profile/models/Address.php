<?php namespace Coolnet\Profile\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 */
class Address extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'coolnet_profile_address';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User', 'key' => 'user_id', 'otherKey' => 'id'],
        ];

    public function getUserIdOptions(){
        return User::lists('name','id');
    }
}
