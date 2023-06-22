<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Donation;
use App\Models\Subscriber;
use App\Models\User;
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

    public function donation(Request $request) {
        $category = Category::orderBy('name')
            ->get()
            ->pluck('name', 'id'); //pluck('value', 'key')
            
        $campaign = Campaign::when($request->has('categories') && count($request->categories) > 0,
            function ($query) use($request) {
                $query->whereHas('category_campaign', function ($query) use($request) {
                    $query->whereIn('category_id', $request->categories);
                });
            }
        )
        ->orderBy('publish_date', 'desc')
        ->paginate(9)
        ->withQueryString();

        return view('front.donation.index', compact('category', 'campaign'));
    }

    public function donationDetail($id) {
        $campaign = Campaign::findOrFail($id);

        return view('front.donation.show', compact('campaign'));
    }

    public function donationCreate($id) {
        $campaign = Campaign::findOrFail($id);
        $user = User::whereHas('role', function ($query) {
                $query->where('name', 'donatur');
            }
        )
        ->get();

        return view('front.donation.create', compact('campaign', 'user'));
    }

    public function storeDonatian(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'nominal' => 'integer|min:500',
            'user_id' => 'required|exists:users,id',
            'anonim' => 'nullable|in:1,0',
            'support' => 'nullable',
        ]);

        if ($validated->fails()) {
            return back()
                ->withInput()
                ->withErrors($validated->errors());
        }

        $campaign = Campaign::findOrFail($id);

        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'nominal' => $request->nominal,
            'user_id' => $request->user_id,
            'anonim' => $request->anonim,
            'support' => $request->support,
            'order_number' => 'PX'. mt_rand(000000, 999999),
            'status' => 'not confirmed'
        ]);

        return redirect('/donation/'. $campaign->id .'/payment/'. $donation->order_number)
                ->with([
                    'message' =>'Donasi baru berhasil disimpan',
                    'success' => true
                ]);
    }

    public function donationPayment($id, $order_number) {
        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();
        $bank = Bank::all();

        if (! $donation) {
            abort(404);
        }

        return view('front.donation.payment', compact('campaign', 'donation', 'bank'));
    }

    public function donationPaymentConfirmation($id, $order_number) {
        $campaign = Campaign::findOrFail($id);
        $donation = Donation::where('order_number', $order_number)->first();

        if (! $donation) {
            abort(404);
        }

        return view('front.donation.payment', compact('campaign', 'donation'));
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
