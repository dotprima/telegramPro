<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;

class SettingAccount extends Component
{
    public $name,$last_name,$email,$organization,$phone_number,$address,$state,$zip_code,$country,$language,$timezone,$currency,$elementName ;

    protected $rules = [
        'name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'organization' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'state' => 'required',
        'zip_code' => 'required',
    ];

    public $selected = '';

    public $series = [
        'Wanda Vision',
        'Money Heist',
        'Lucifer',
        'Stranger Things',
    ];

    public function mount(Request $request) {
        $users = User::find($request->user()->id);
        $this->name = $users['name'];
        $this->last_name = $users['last_name'];
        $this->email = $users['email'];
        $this->organization = $users['organization'];
        $this->phone_number = $users['phone_number'];
        $this->address = $users['address'];
        $this->state = $users['state'];
        $this->zip_code = $users['zip_code'];
        $this->country =  $users['country'];
        $this->language =  $users['language'];
        $this->timezone =  $users['timezone'];
        $this->currency =  $users['currency'];
    }

    public function render()
    {
       
        return view('livewire.profile.setting-account');
    }

    public function updateAccount(Request $request){

        $this->validate();

        // $request->user()->update([
        //     'password' => Hash::make($this->password),
        // ]);
        // $this->post->save();\
        $users = User::find($request->user()->id);
        
        $users->name = $this->name;
        $users->last_name = $this->last_name;
        $users->email = $this->email;
        $users->organization = $this->organization;
        $users->phone_number = $this->phone_number;
        $users->address = $this->address;
        $users->state = $this->state;
        $users->zip_code = $this->zip_code;
        $users->country = $this->country;
        $users->language = $this->language;
        $users->timezone = $this->timezone;
        $users->currency = $this->currency;
        $users->updated_at = NOW();

        if($users->save()){
            session()->flash('message', 'Account successfully updated.');
        }else{
            session()->flash('error', 'Account successfully updated.');
        }

        
       
    }
}
