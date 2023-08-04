<?php

namespace App\Http\Controllers\Front;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;
use App\Models\Transaction;

class TransactionController extends Controller
{
    function show($reference) {
        // dd($reference); refrence harus dapat kode
        $tripay = new TripayController();
        $detail = $tripay->detailTransaction($reference);

        return view('front.transaction.show', compact('detail'));
    }

    function transaction_store(Request $request) {
        // Request Tranaction in Tripay
        $donation = Donation::latest()->first();
        $method = $request->method;

        $tripay = new TripayController();
        $transaction = $tripay->requestTransaction($method, $donation);
        
        // Create a new data in Transaction Model
        Transaction::create([
            'user_id' => auth()->user()->id,
            'donation_id' => $donation->id,
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'total_amount' => $transaction->amount,
            'status' => $transaction->status
        ]);

        return redirect()->route('transaction.show', [
            'reference' => $transaction->reference
        ]);
    }
}
