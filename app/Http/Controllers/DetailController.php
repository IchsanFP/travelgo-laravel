<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;


class DetailController extends Controller
{
    public function index(Request $request, $slug){
        $item = TravelPackage::with(['galleries', 'user'])
        ->where('slug', $slug)
        ->firstOrFail();
        return view('pages.detail', [
            'item' => $item
        ]);
    }
}
