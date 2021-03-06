<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index() 
    {
        return view('user.profile.index');
    }

    public function update(Request $request) 
    {

        if($request->name != $request->user()->name) {
            $this->validate($request, [
                'name' => 'required|string|min:3|max:255', 
            ]);
        }

        if($request->email != $request->user()->email) {
            $this->validate($request, [
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        $request->user()->fill($request->input())->save();

        return redirect()->back()->withSuccess('Profile has been updated!');
    }

    public function show(User $user) 
    {
        $profileuser = $user; 
        $currentuser = Auth::user(); 

        // if($profileuser == $currentuser) {
        //     return redirect()->route('user.profile.index');
        // }

        return view('user.profile.show', compact('profileuser'));
    }
}
