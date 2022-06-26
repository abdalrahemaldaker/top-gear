<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoggedIn;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use Notifiable;
    public function show(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
         //dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //dd(Hash::make($credentials['password']));
        //dd($credentials['password']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //sending email to User
            $user=User::where('email',$credentials['email'])->first();
            $user->notify(new LoggedIn);
            return redirect()->intended(route('admin.cars.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login',['locale' => session('lang',config('app.locale'))]));
    }

}
