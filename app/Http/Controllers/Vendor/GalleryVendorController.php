<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\TravelPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GalleryVendorController extends Controller
{
    public function index(Request $request){
        $account = Auth::user()->id;
        $items = Gallery::with(['travel_package'])->get();
        return view('pages.vendor.gallery.index', [
            'items' => $items, 'account' => $account
        ]);
    }

    public function create()
    {
        $account = Auth::user()->id;
        $travel_packages = TravelPackage::where('vendor_id', $account)->get();
        return view('pages.vendor.gallery.create', [
            'travel_packages' => $travel_packages
        ]);
    }

    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );

        Gallery::create($data);
        return redirect()->route('gallery-vendor.index');
    }

    public function edit($id)
    {
        $item = Gallery::findOrFail($id);
        $account = Auth::user()->id;
        $travel_packages = TravelPackage::where('vendor_id', $account)->get();
        return view('pages.vendor.gallery.edit', [
            'item' => $item,
            'travel_packages' => $travel_packages
        ]);
    }

    public function update(GalleryRequest $request, $id)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );

        $item = Gallery::findOrFail($id);

        $item->update($data);

        return redirect()->route('gallery-vendor.index');
    }

    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();

        return redirect()->route('gallery-vendor.index');
    }
}
