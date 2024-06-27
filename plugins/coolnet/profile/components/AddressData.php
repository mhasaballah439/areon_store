<?php namespace Coolnet\Profile\Components;

use Coolnet\Profile\Models\Address;
use Input;
use Log;
use Auth;
use Cms\Classes\ComponentBase;
use October\Rain\Support\Facades\Flash;

class AddressData extends ComponentBase
{

    public function componentDetails()
    {

        return [
            'name' => 'User Address',
            'description' => 'Return all User Address'
        ];

    }

    public function onRun()
    {
        $this->address_list = $this->page['address_list'] = $this->getAddressList();
    }


    public function onStoreAddress(){
        if (Auth::check()){
            $address = new Address;
            $address->user_id = Auth::getUser()->id;
            $address->city = Input::get('city');
            $address->street = Input::get('street');
            $address->full_name = Input::get('full_name');
            $address->mobile = Input::get('mobile');
            $address->building = Input::get('building');
            $address->zip_code = Input::get('zip_code');
            $address->save();

            Flash::success('Address successfully added');
        }
    }

    public function getAddressList(){
        if (Auth::check())
            return Address::where('user_id',Auth::getUser()->id)->get();
    }

    public function onRemoveAddress(){
        if (Auth::check()){
            $address =  Address::find(Input::get('id'));
            $address->delete();

            Flash::success('Address successfully added');
        }
    }

}
