<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{

public function get ($locale)
{
    if (! in_array($locale, ['en', 'ar'])) {
        return redirect()->back()->with(['message'=> 'Unsupported language','message-color'=>'warning'] );
    }
    session(['lang' => $locale]);
    App::setLocale($locale);
    return redirect()->route('home');

}


}
