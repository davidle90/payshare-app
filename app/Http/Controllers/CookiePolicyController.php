<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookiePolicyController extends Controller
{
    public function index()
    {
        return view('pages.public.cookie-policy.index');
    }
}
