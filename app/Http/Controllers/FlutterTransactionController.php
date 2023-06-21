<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Illuminate\Http\Request;

class FlutterTransactionController extends Controller
{
    public function transaction(Request $request) {
        $data = $request->validate([
            "travel_packages_id" => "required",
            "users_id" => "required",
            "transaction_total" => "required",
            "transaction_status" => "required",
        ]);

        // create transaction
        $transaction = Transaction::create([
            'travel_packages_id' => $data['travel_packages_id'],
            'users_id' => $data['users_id'],
            'transaction_total' => $data['transaction_total'],
            'transaction_status' => $data['transaction_status'],
        ]);

        return response([
            "transaction" => $transaction,
        ]);
    }

    public function detailTransaction(Request $request) {
        $data = $request->validate([
            "transactions_id" => "required",
            "name" => "required",
            "nik_ktp" => "required",
        ]);

        $detail = TransactionDetail::create([
            "transactions_id" => $data["transactions_id"],
            "name" => $data["name"],
            "nik_ktp" => $data["nik_ktp"],
        ]);

        return response([
            "detailTransaction" => $detail,
        ]);
    }

    public function update(Request $request, $id) {
        $transaction = Transaction::findOrFail($id);

        $transaction->transaction_status = $request->input('transaction_status');

        $transaction->save();

        return response()->json(['message' => 'Transaction updated successfully']);
    }

    public function getUserHistory(Request $request, $userId) {
        $transaction = Transaction::where('users_id', $userId)->get();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        return response([
            "transaction" => $transaction,
        ]);
        
    }

    public function getPackageTransactions(Request $request, $packageId) {
        $transaction = Transaction::where('travel_packages_id', $packageId)->where('transaction_status', "SUCCESS")->get();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        return response([
            "transaction" => $transaction,
        ]);
        
    }

    public function getDetailTransaction(Request $request, $transId) {
        $transaction = TransactionDetail::where('transactions_id', $transId)->get();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        return response([
            "detailTransaction" => $transaction,
        ]);
        
    }
}
