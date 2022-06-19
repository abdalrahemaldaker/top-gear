<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(3);
        $users->withquerystring();
       return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated=$request->validate([
            'name'      =>      'required|string',
            'email'     =>      'required|email',
            'password'  =>      'confirmed',
        ]);
        if($validated['email']==$user->email){
            $user->update($validated);
            session()->flash('message' , 'updated succesfuly');
             session()->flash('message-color' , 'success');
             return redirect()->route('admin.users.index');
        }
        else return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message' , 'Deleted succesfuly');
        session()->flash('message-color' , 'warning');
        return redirect()->route('admin.users.index');
    }
}
