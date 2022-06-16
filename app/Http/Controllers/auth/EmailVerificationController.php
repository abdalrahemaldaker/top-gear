<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function send ()
    {
        return view('auth.verify-email');
    }

    public function receive(EmailVerificationRequest $request)
    {
        $request->fulfill();

    return redirect('/admin/cars');

    }

    public function resend(Request $request)
    {
            $request->user()->sendEmailVerificationNotification();

            return back()->with('message', 'Verification link sent!');
    }


}
