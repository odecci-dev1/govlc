<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function store()
    {      
        $validatedata = $this->validate(); 

        $user = User::create([
            'fname' => $validatedata['userhdr']['fname'],
            'mname' => $validatedata['userhdr']['mname'],
            'lname' => $validatedata['userhdr']['lname'],
            'contact_number' => $validatedata['userhdr']['contact_number'],
            'address' => $validatedata['userhdr']['address'],
            'email' => $validatedata['userhdr']['email'],
            'global' => $validatedata['userhdr']['global'],
            'password' => Hash::make( $validatedata['userhdr']['password']),
        ]);
        
        event(new Registered($user));  
        

        if(count($this->modules) > 0){
            foreach($this->modules as $modules){
                $crt = UsersModule::firstOrCreate([
                    'user_id' => $user->id, 'module_code' => $modules, 'created_by' => Auth::user()->id,
                ]);
            }
        }
        return redirect('/user/view/'.$user->email)->with('message', 'User successfully created.');  
    }

}
