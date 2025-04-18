<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('user.profile');
    }

    public function updatePassword(Request $request)
    {
        // form validation
        $request->validate(
            [
                'current_password' => 'required|min:8|max:16',
                'new_password' => 'required|min:8|max:16|different:current_password',
                'new_password_confirmation' => 'required|same:new_password',
            ]
        );

        $user = auth()->user();

        // check if the current password is correct 
        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Senha atual incorreta.');
        }

        // update password in database
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Senha alterada com sucesso.');
    }
}
