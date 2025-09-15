<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Spp;
use App\Models\Student;
use App\Models\ClassModel;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $students = Student::all(); // or add pagination/filter if needed
        return view('spp.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2020|max:2030',
            'month' => 'required|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'nominal' => 'required|integer|min:0',
            'student' => 'required|exists:students,student_id'
        ]);

        $spp = Spp::create([
            'year' => $request->year,
            'month' => $request->month,
            'nominal' => $request->nominal
        ]);

        $student = Student::findOrFail($request->student);
        $student->update([
            'spp_id' => $spp->spp_id
        ]);

        return redirect()->route('admin.spp.index')->with('success', 'SPP berhasil ditambahkan dan dikaitkan ke siswa.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $spp = Spp::findOrFail($id);
        $students = Student::all();
        $classes = ClassModel::all();
        return view('admin.spp.edit', compact('spp', 'students', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'year' => 'required|integer|min:2020|max:2030',
            'month' => 'required|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'student' => 'required|exists:students,student_id',
            'nominal' => 'required|integer|min:0'
        ]);
    
        $spp->update([
            'year' => $request->year,
            'month' => $request->month,
            'student_id' => $request->student,
            'nominal' => $request->nominal
        ]);
    
        return redirect()->route('admin.spp.index')->with('success', 'SPP berhasil diperbarui.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spp $spp, Request $request)
    {
        $student = Student::findOrFail($request->student);
        $spp = Spp::findOrFail($student->spp_id);

        $student->update([
            'spp_id' => null
        ]);

        $spp->delete();
    
        return redirect()->back()->with('success', 'SPP berhasil dihapus.');
    }
    
    
}
