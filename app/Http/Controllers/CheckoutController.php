<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);
        try {
            $transaction = Transaction::create([
                'travel_packages_id' => $id,
                'users_id' => Auth::user()->id,
                'transaction_total' => $travel_package->price,
                'transaction_status' => 'IN_CART'
            ]);
    
            $payment_proof = null;
            if ($request->hasFile('payment_proof')) {
                $request->validate([
                    'payment_proof' => 'required|image|max:2048',
                ]);
    
                $path = $request->file('payment_proof')->getRealPath();
                $payment_proof = base64_encode(file_get_contents($path));
            }
    
            $transaction->payment_proof = $payment_proof;
            $transaction->save();
    
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'name' => Auth::user()->name,
                'nik_ktp' => 32101
            ]);
            if (request()->segment(1) == 'api') return response()->json([
                "error" => false,
                "message" => "Berhasil"
            ]);
    
            return redirect()->route('checkout', $transaction->id);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ada Yang Error Berarti.']);
        }
    }
    


    public function upload(Request $request, $id)
    {
        
        $request->validate([
            'payment_proof' => 'required|file|max:2048',
        ]);
        
        try {
            $proof = $request->file('payment_proof');
            $payment_proof = $proof->store('payment', 'public');
    
            $transaction = Transaction::findOrFail($id);
            
            $transaction->payment_proof = $payment_proof;
            $transaction->transaction_status = 'PENDING';
            $transaction->save();
    
            return redirect()->route('checkout-success', $id);
        } catch (\Exception $e) {
            dd($e->getMessage()); // or use logging or return an error message
        }
    }
    

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findorFail($detail_id);
        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($item->transactions_id);

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'nik_ktp' => 'required|integer'
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->find($id);

        $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'SUCCESS';
        $transaction->save();
        return view('pages.success');
    }
}