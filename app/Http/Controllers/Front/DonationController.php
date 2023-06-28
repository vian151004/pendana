<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function index(Request $request) {
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

    public function show($id) {
        $campaign = Campaign::findOrFail($id);

        return view('front.donation.show', compact('campaign'));
    }

    public function create($id) {
        $campaign = Campaign::findOrFail($id);
        $user = User::whereHas('role', function ($query) {
                $query->where('name', 'donatur');
            }
        )
        ->get();

        return view('front.donation.create', compact('campaign', 'user'));
    }

    public function store(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'nominal' => 'required|integer|min:500',
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
}
