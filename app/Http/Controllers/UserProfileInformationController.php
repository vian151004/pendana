<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileInformationController extends Controller
{
    function show(Request $request) {
        return view('profile.show', [
            'request' => $request,
            'user' => $request->user(),
            'bank' => Bank::all()->pluck('name', 'id') 
        ]);
    }  
    
    function bankDestroy(Request $request, $id) 
    {
        $request->user()->bank_user()->detach($id);

        return back()->with([
            'message' => 'Bank Terdaftar berhasil dihapus',
            'success' => true
        ]);
    }

    function email_verification($id, $token)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->email_verified_at) {
                return "Email sudah diverifikasi";
            }

            $user->update([
                'email_verified_at' => now(),
                'remember_token' => $token
            ]);
        }

        return "Email berhasil diverifikasi";
    }
}
