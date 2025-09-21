<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Users;
use App\Models\Spp;

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = session('user_id');

        $students = Student::where('user_id', $userId)
            ->with('spp') // eager load spp
            ->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all();
        return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'nis' => 'required|string|max:50|unique:students,nis',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'foto' => 'required|image|max:2048',
            'class_id' => 'required|exists:classes,class_id',
        ]);

        // Handle file upload
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('students', 'public');
        }

        // Create student tied to logged-in user
        $student = Student::create([
            'name' => $request->name,
            'age' => $request->age,
            'nis' => $request->nis,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'foto' => $fotoPath,
            'class_id' => $request->class_id,
            'user_id' => session('user_id'),
        ]);

        $user = Users::find(session('user_id'));

        if ($user->role == "student") {
            return redirect()->route('students.index')->with('success', 'Student created successfully.');
        } else {
            // Handle student role redirect
            return redirect()->route('admin.students.index')->with('success', 'Profile created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::where('student_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::where('student_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        $classes = ClassModel::all();
        $user = Users::findOrFail(session('user_id'));
        return view('students.edit', compact('student', 'classes', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::where('student_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'nis' => 'required|string|max:50|unique:students,nis,' . $student->student_id . ',student_id',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
            'class_id' => 'required|exists:classes,class_id',
        ]);

        // Handle file upload if exists
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('students', 'public');
            $student->foto = $fotoPath;
        }

        $student->update([
            'name' => $request->name,
            'age' => $request->age,
            'nis' => $request->nis,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::where('student_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $student->delete();


        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');

    }
}