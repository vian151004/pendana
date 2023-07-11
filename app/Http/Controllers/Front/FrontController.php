<?php

namespace App\Http\Controllers\Front;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class FrontController extends Controller
{
    public function index() {
        $donatur = User::whereHas('donations')->count();
        $misiSukses = Campaign::whereHas('cashouts')->count();
        $relawan = User::whereHas('campaigns')->count();
        $projek = Campaign::where('status', 'publish')->count();

        $campaign = Campaign::where('status', 'publish')
            ->orderBy('publish_date', 'desc')
            ->where('status', 'publish')
            ->paginate(6);
        
        return view('front.welcome', compact('campaign', 'donatur', 'misiSukses', 'relawan', 'projek'));
    }
}
