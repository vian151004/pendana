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
        $validated = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'path_image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
        
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        if (isset($input['path_image'])) {
            $input['path_image'] = upload('user', $input['path_image'], 'user');
        }

    //     if (isset($input['path_image'])) {
    //         if (Storage::disk('public')->exists($user->path_image)) {
    //             Storage::disk('public')->delete($user->path_image);
    //         }

    //         $input['path_image'] = upload('user', $input['path_image'], 'user');
    //      }

        $user->update($input);

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
