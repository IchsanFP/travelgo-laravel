<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = TravelPackage::with(['galleries'])->get();

        if (request()->segment(1) == 'api') return response() -> json([
            "error" => false,
            "items" => $items,
        ]);
        return view('pages.travel', [
            'items' => $items
        ]);
    }

    public function getVendorPackages(Request $reques, $userId) {
        $package = TravelPackage::where('vendor_id', $userId)->get();

        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

        return response([
            "items" => $package,
        ]);
    }
}