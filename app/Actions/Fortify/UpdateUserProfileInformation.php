<?php

namespace App\Actions\Fortify;

use Error;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input)
    {
        $rules =  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'path_image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        if (! empty($input['pills']) && $input['pills'] == 'bank') {
            $rules = [
                // 'required|exists:bank,id|unique:bank_user,bank_id'
                'bank_id' => [
                    'required',
                    'exists:bank,id',
                    Rule::unique('bank_user')->where(function ($query) use ($input) {
                        return ! $query->where('user_id', auth()->id())
                                       ->where('user_id', $input['bank_id']);
                    })
                ],
                'account' => 'required|unique:bank_user,account',  
                'name' => 'required', 
                'is_main' => [
                    'nullable',
                    Rule::unique('bank_user')->where(function ($query) use ($input) {
                        $countAvailable = $query->where('user_id', auth()->id())
                            ->where('is_main', 1)
                            ->count();
                        
                        if ($input['is_main'] == 1 && $countAvailable > 0) {
                            return false;
                        }

                        return true;
                    })
                ]
            ];
        }

        $validated = Validator::make($input, $rules, [
            'is_main.unique' => 'Akun utama sudah ada sebelumnya.'
        ]);
        
        if ($validated->fails()) {
            return back()
                ->withInput()
                ->withErrors($validated->errors());
        }

        if (isset($input['path_image'])) {
            $input['path_image'] = upload('user', $input['path_image'], 'user');
        }

        $user->update($input);

        if (! empty($input['pills']) && $input['pills'] == 'bank') {
            $user->bank_user()->attach($input['bank_id'], [
                'account' => $input['account'],
                'name' => $input['name'],
                'is_main' => $input['is_main'] ?? 0
            ]);
        }

        session()->flash('message', 'Profil berhasil diperbarui');
        session()->flash('success', true);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();        
    }
}
