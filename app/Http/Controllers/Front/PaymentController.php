<?php

namespace App\Http\Controllers\Front;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index($id, $order_number) {
        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();
        $bank = Bank::all();

        if (! $donation) {
            abort(404);
        }

        return view('front.donation.payment', compact('campaign', 'donation', 'bank'));
    }

    public function paymentConfirmation($id, $order_number) {
        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();
        $payment = Payment::where('order_number', $order_number)->first() ?? new Payment;
        $bank = Bank::all()->pluck('name', 'id');

        if (! $donation) {
            abort(404);
        }

        return view('front.donation.payment_confirmation', compact('campaign', 'donation', 'payment', 'bank' ));
    }

    public function store(Request $request, $id, $order_number) {
        $payment = Payment::where('order_number', $order_number)->first();

        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'nominal' => 'required|integer|min:500',
            'bank_id' => 'required|exists:bank,id',
            'path_image' => $payment ? 'nullable|mimes:png,jpg,jpeg,pdf|max:2048' : 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            'note' => 'nullable',
        ]);

        if ($validated->fails()) {
            return back()
                ->withInput()
                ->withErrors($validated->errors());
        }

        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();

        if (! $donation) {
            abort(404);
        }

        if ($donation->status == 'confirmed') {
            return back()
                ->with([
                    'message' =>'Pembayaran sudah dikonfirmasi',
                    'error_msg' => true
                ]);
        }

        $data = $request->except('path_image');
        $data['user_id'] = $campaign->user_id;
        $data['order_number'] = $donation->order_number;
        if ($request->has('path_image')) {
            if (Storage::disk('public')->exists($campaign->path_image)) {
                Storage::disk('public')->delete($campaign->path_image);
            }
            
            $data['path_image'] = upload('payment', $request->file('path_image'), 'payment');
        }
        

        Payment::updateOrCreate(
            ['order_number' => $donation->order_number],
            $data
        );

        return back()
                ->with([
                    'message' =>'Konfirmasi pembayaran berhasil disimpan',
                    'success' => true
                ]);
    }
}