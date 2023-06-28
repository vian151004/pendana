<?php

namespace App\Http\Controllers\Front;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index() {
        $campaign = Campaign::orderBy('publish_date', 'desc')
            ->limit(6)
            ->get();
        
        return view('front.welcome', compact('campaign'));
    }
}
