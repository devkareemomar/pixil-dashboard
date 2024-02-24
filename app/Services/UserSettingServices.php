<?php

namespace App\Services;

use App\Interface\UserSettingInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserSettingServices implements UserSettingInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        $splitName = explode(' ', $user->name, 2);
        $user['first_name'] = $splitName[0];
        $user['last_name'] = !empty($splitName[1]) ? $splitName[1] : '';
        return $user;
    }

    public function update($request)
    {
        $user = $this->user->findOrFail(auth()->user()->id);
        $user['name'] = $request['first_name'] . ' ' . $request['last_name'];
        $user->update($request);
        return true;
    }


    public function changePassword_update($request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed|different:current_password',
        ]);
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => __('The current password is incorrect.')]);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return true;
    }

}
