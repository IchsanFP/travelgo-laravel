<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $items = TravelPackage::with(['galleries'])->get();
        if (request()->segment(1) == 'api') return response() -> json([
            "error" => false,
            "list" => $items,
        ]);
        
        return view('pages.home', [
            'items' => $items
        ]);
    }
}
