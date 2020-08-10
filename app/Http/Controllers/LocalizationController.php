<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function change($lang = 'en') {
    	\Session::put('local', $lang);
    	return redirect()->back();
    }
}
