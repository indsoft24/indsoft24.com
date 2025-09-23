<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function privacyPolicy()
    {
        return view('company.privacy-policy');
    }
    public function termsAndConditions()
    {
        return view('company.terms-and-conditions');
    }
    public function cookiePolicy()
    {
        return view('company.cookie-policy');
    }
}
