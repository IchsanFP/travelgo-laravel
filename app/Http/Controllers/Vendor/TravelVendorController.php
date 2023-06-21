<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Models\Gallery;
use App\Http\Requests\Admin\TravelPackageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TravelVendorController extends Controller
{
    public function index(Request $request){
        $account = Auth::user()->id;
        $items = TravelPackage::with(['user'])->get();
        return view('pages.vendor.travel-package.index', [
            'items' => $items, 'account' => $account
        ]);
    }

    public function create()
    {
        $account = Auth::user()->id;
        return view('pages.vendor.travel-package.create', [
            'account' => $account
        ]);
    }

    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        TravelPackage::create($data);
        return redirect()->route('travel-vendor.index');
    }

    public function edit($id)
    {
        $item = TravelPackage::findOrFail($id);

        return view('pages.vendor.travel-package.edit', [
            'item' => $item
        ]);
    }

    public function update(TravelPackageRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = TravelPackage::findOrFail($id);

        $item->update($data);

        return redirect()->route('travel-vendor.index');
    }

    public function destroy($id)
    {
        $item = TravelPackage::findOrFail($id);
        $galleries = Gallery::where('travel_packages_id', $id);
        $item->delete();
        $galleries->delete();

        return redirect()->route('travel-vendor.index');
    }
}
