<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function panel(User $user)
    {
        if ($user->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        return view('panel', compact('user'));
    }

    public function personal(User $user)
    {
        if ($user->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        return view('personal', compact('user'));
    }

    public function security(User $user)
    {
        if ($user->user_id !== Auth::id() && !Auth::user()->admin) {
            abort(403, 'Rejected.');
        }

        return view('security', compact('user'));
    }


    public function p_update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'unique:users,name,'.$user->id.'|required|string|max:255',
            'email' => 'unique:users,email,'.$user->id.'|required|email|max:255',
            'admin' => 'required|in:0,1',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->admin = $data['admin'];

        $user->update();
//dd($user);
        return redirect('/');
    }


    public function s_update(Request $request, User $user)
    {

        $data = $request->validate([
            'password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
            'password_confirm' => 'required|string|max:255',
        ]);


        if (Hash::check($data['password'], $user->password)) {
            if ($data['new_password'] == $data['password_confirm']) {
                $user->password = Hash::make($data['new_password']);
                $user->save();

                return redirect('/')->with('success', 'Password changed successfully!');
            } else {
                return redirect()->back()->with('error', "Passwords don't match.");
            }
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }


    }



}
