<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index() {
        return view('front.contact');
    }

    public function store(Request $request) {
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
}
