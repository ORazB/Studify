<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        
        // Get the student for this user
        $student = Student::where('user_id', $userId)->first();
        
        // Pass the student data to the dashboard view
        return view('dashboard', compact('student'));
    }
}