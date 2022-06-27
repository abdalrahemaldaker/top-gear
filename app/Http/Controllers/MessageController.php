<?php

namespace App\Http\Controllers;

use App\Events\MessageReceived;
use App\Mail\ContactThanks;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
  public function store (Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'content' => 'required',
        ]);
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->content = $request->content;
        $message->save();
        $email=$message->email;
        //sending mail
        MessageReceived::dispatch($email);


        return redirect('/#contact');
    }

    public function index () {
        $messages = Message::all();

        return view('messages.index', compact('messages'));
    }


    public function show (message $message) {
        return view('messages.show', compact('message'));
    }
}
