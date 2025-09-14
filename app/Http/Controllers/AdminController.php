<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Spp;
use App\Models\Payment;
use App\Models\ClassModel;
use App\Models\Users;

class AdminController extends Controller
{

    // Students
    public function studentIndex(Request $request)
    {
        // Creates a new query
        $query = Student::query();

        if ($request->has('class_id') && $request->class_id !== 'all') {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->get();
        $classes = [
            1 => 'PPLG',
            2 => 'TJKT',
            3 => 'Akuntansi',
            4 => 'DKV',
        ];

        return view('admin.students.index', compact('students', 'classes'));
    }

    public function studentCreate()
    {
        $classes = ClassModel::all();
        $users = Users::all();
        $students = Student::all();
        return view('admin.students.create', compact('classes', 'users', 'students'));
    }

    public function studentEdit($id)
    {
        $classes = ClassModel::all();
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('classes', 'student'));
    }

    // Spp
    public function sppIndex(Request $request)
    {
        $query = Student::query();

        if ($request->has('class_id') && $request->class_id !== 'all') {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->with('spp')->get();

        $classes = [
            1 => 'PPLG',
            2 => 'TJKT',
            3 => 'Akuntansi',
            4 => 'DKV',
        ];

        return view('admin.spp.index', compact('students', 'classes'));
    }


    public function sppCreate()
    {
        $students = Student::all();
        $classes = ClassModel::all();
        return view('admin.spp.create', compact('students', 'classes'));
    }

    public function sppEdit($id)
    {
        $spp = Spp::findOrFail($id);
        return view('users.edit', compact('spp'));
    }


    // Payment
    public function paymentIndex()
    {
        $payments = Payment::all();
        return view('admin.payment.index', compact('payments'));
    }

    public function paymentCreate()
    {
    }

    public function paymentEdit($id)
    {
        $payment = Spp::findOrFail($$id);
        return view('users.edit', compact('payments'));
    }

    // Class
    public function classIndex()
    {
        $classes = ClassModel::all();
        return view('admin.classes.index', compact('classes'));
    }
}
