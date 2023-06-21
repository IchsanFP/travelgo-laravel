<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TravelPackage;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardVendorController extends Controller
{
    public function index(Request $request){
        $account = Auth::user()->id;
        return view('pages.vendor.dashboard', [
            'travel_package' => TravelPackage::where('vendor_id', $account)->count(),
        ]);
    }
}
