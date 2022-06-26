<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use App\Mail\ContactThanks;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendThanksEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MessageReceived  $event
     * @return void
     */
    public function handle(MessageReceived $event , $email)
    {
        Mail::to($email)->send(new ContactThanks );
    }
}
