<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Illuminate\Support\Facades\Session;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input)
    {
        $validated = Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' =>['required', 'string', 'confirmed'],
        ])->after(function ($validator) use ($user, $input) {
            if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });
        // , [
        //     'current_password.current_password' => __('The provided password does not match your current password.'),
        // ]);

        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        Session::flash('message', 'Password berhasil diperbarui');
        Session::flash('success', true);
    }
}
