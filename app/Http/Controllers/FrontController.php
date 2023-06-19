<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index() {
        $campaign = Campaign::orderBy('publish_date', 'desc')
            ->limit(6)
            ->get();
        
        return view('front.welcome', compact('campaign'));
    }

    public function contact() {
        return view('front.contact');
    }

    public function storeContact(Request $request) {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'subject' => 'required|min:4',
            'message' => 'required|min:4'
        ]);

        if ($validated->fails()) {
            return back()
                ->withInput()
                ->withErrors($validated->errors());
        }

        Contact::create($request->all()); // only('email') karena data email di set untuk unique

        return back()
                ->with([
                    'message' =>'Kontak baru berhasil disimpan',
                    'success' => true
                ]);
    }

    public function about() {
        return view('front.about');
    }

    public function donation() {
        return view('front.donation.index');
    }

    public function donationDetail($id) {
        return view('front.donation.show');
    }

    public function donationCreate($id) {
        return view('front.donation.create');
    }

    public function donationPayment($id) {
        return view('front.donation.payment');
    }

    public function donationPaymentConfirmation($id) {
        return view('front.donation.payment-confirmation');
    }

    public function subscriberStore(Request $request) {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);
        
        if ($validated->fails()) {
            return back()
                ->withInput()
                ->with([
                    'message' => $validated->errors()->first(),
                    'errors' => true
                ]);
        }

        Subscriber::create($request->only('email')); // only('email') karena data email di set untuk unique

        return back()
                ->with([
                    'message' =>'Subscriber baru berhasil ditambahkan',
                    'success' => true
                ]);
    }
}
