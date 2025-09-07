<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = Users::where('username', $request->username)->first();

        if($user && password_verify($request->password, $user->password)) {
            
            // Store Session
            session([
                'user_id' => $user->user_id,
                'username' => $user->username,
                'role' => $user->role,
            ]);

            return redirect()->route('users.index');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
