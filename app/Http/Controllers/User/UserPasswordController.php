<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    public function index() 
    {
        return view('user.profile.password.index');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->get('current'), Auth::user()->password))) {
            return redirect()->back()->withError('Current password is incorrect!');
        }

        if(strcmp($request->get('current'), $request->get('password')) == 0){
            return redirect()->back()->withError('Your new password may not be the same as your current password.');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back()->withSuccess('Password changed successfully!');
    }
}
