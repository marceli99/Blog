<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_new_password' => ['same:new_password'],
        ]);

        $user = User::find(auth()->user()->id);
        if (array_key_exists('new_email', $request->input())) {
            $user->update([
                'email'=> $request->input()['new_email'],
                'password'=> Hash::make($request->input()['new_password']),
            ]);
        } else {
            $user->update(['password'=> Hash::make($request->input()['new_password'])]);
        }


        return Redirect::back()->with('success', 'Changed login data successfully.');
    }
}
