<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class PageController extends Controller
{
    public function index(Request $request)
    {
       $user = $request->user();
       return view('auth.login')->with(['user' => $user]);
    }

    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact')->with([
            'email' => config('app.supportEmail')
        ]);
    }
}