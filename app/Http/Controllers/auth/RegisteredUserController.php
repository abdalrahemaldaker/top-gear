<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated= $request->validate([
            'name'      =>      'required|string',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|confirmed',
        ]);
        $user=User::create($validated);
        event(new Registered($user));
        Auth::login($user);


        session()->flash('message' , 'User added');
        session()->flash('message-color' , 'success');
        return redirect()->route('verification.notice');
        //return redirect()->intended(route('admin.cars.index'));
    }
}
