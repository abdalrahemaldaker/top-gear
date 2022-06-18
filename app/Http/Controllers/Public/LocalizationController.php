<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{

public function get ($locale)
{
    session(['lang' => $locale]);
//    dd($locale);
    App::setLocale($locale);
    //return redirect()->route('home');
    return redirect()->route('home',['locale' => $locale]);

}


}
