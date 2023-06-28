<?php

namespace App\Http\Controllers\Front;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);
        
        if ($validated->fails()) {
            return back()
                ->withInput()
                ->with([
                    'message' => $validated->errors()->first(),
                    'error_msg' => true
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
