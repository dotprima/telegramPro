<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class SettingSecurity extends Component
{

    public $password,$current_password,$password_confirmation;
    
    protected $rules = [
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'current_password' => 'required|min:8',
        'password_confirmation' => 'required|min:8',
    ];


    public function render()
    {
        return view('livewire.profile.setting-security');
    }

    public function updatePassword(Request $request){

        $this->validate();

        // $request->user()->update([
        //     'password' => Hash::make($this->password),
        // ]);
        // $this->post->save();\
        $users = User::find($request->user()->id);
        
        $users->password = Hash::make($this->password);
        
        if($users->save()){
            session()->flash('message', 'Password successfully updated.');
        }else{
            session()->flash('error', 'Password successfully updated.');
        }

        
       
    }
}
