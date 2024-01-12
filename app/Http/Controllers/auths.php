<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class auths extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function register(Request $request){
        $record = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'staff_id' => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);



        $user = User::create($record);

        event(new Registered($user));
        return redirect()->route('dashboard');
    }


    public function login(Request $request){
        $record = $request->validate([
            'staff_id' => 'required|string',
            'password' => 'required|string',
            
        ]);

        $attempt = Auth::guard('web')->attempt($record);

        if ($attempt) 
        {
            return redirect()->route('dashboard');
        }else {
            return 'hi';
        }   
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
      
    }
}
