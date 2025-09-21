<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Student;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('/login');
    }

    public function login(Request $request)
    {
        $user = Users::where('username', $request->username)->first();

        if($user && password_verify($request->password, $user->password)) {
            
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Store Session
            session([
                'user_id' => $user->user_id,
                'username' => $user->username,
                'role' => $user->role,
            ]);

            if ($user->role === 'admin') {
                return redirect()->route(route: 'users.index');
            } else if ($user->role === 'student') {

                $student = Student::where('user_id', $user->user_id)->first();

                if ($student) {
                    return redirect()->route('students.index');
                } else {
                    return redirect()->route('students.create');
                }

            } else {
                return back()->with('error', 'Role not recognized');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
