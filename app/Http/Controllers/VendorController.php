<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function login(Request $request){
        return view('auth.vendor_login');
    }

    public function register(Request $request){
        return view('auth.register_vendor');
    }
}
