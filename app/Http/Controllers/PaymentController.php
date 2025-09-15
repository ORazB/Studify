<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Student;
use App\Models\Spp;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules

        // Check if SPP belongs to the selected student

        // Create the payment
        Payment::create([
            'student_id' => $request->student_id,
            'spp_id' => $request->spp_id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
            'status' => 'pending',
        ]);

        Spp::findOrFail($request->spp_id)->update([
            'status' => 'pending'
        ]);

        // Get student name for success message
        $student = Student::find($request->student_id);
        $studentName = $student ? $student->name : 'Unknown Student';

        return redirect()->refresh()
            ->with('success', "Payment of Rp " . number_format($request->amount_paid, 0, ',', '.') . " for {$studentName} has been recorded successfully.");
    }

    /**
 * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load(['student', 'spp']);
        return view('admin.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $students = Student::orderBy('name')->get();
        $spps = Spp::with('student')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

        $classes = [
            1 => 'PPLG',
            2 => 'TJKT',
            3 => 'Akuntansi',
            4 => 'DKV',
        ];

        return view('admin.payment.edit', compact('payment', 'students', 'spps', 'classes'));
    }

    /**
     * Update the specified payment in storage
     */
    public function update(Request $request, Payment $payment)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'spp_id' => 'nullable|exists:spp,id',
            'amount_paid' => 'required|integer|min:1000',
            'payment_date' => 'required|date|before_or_equal:today',
        ], [
            'student_id.required' => 'Please select a student.',
            'student_id.exists' => 'The selected student does not exist.',
            'spp_id.exists' => 'The selected SPP record does not exist.',
            'amount_paid.required' => 'Payment amount is required.',
            'amount_paid.integer' => 'Payment amount must be a number.',
            'amount_paid.min' => 'Payment amount must be at least Rp 1,000.',
            'payment_date.required' => 'Payment date is required.',
            'payment_date.date' => 'Please enter a valid date.',
            'payment_date.before_or_equal' => 'Payment date cannot be in the future.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Additional validation: Check if SPP belongs to the selected student
        if ($request->spp_id) {
            $spp = Spp::find($request->spp_id);
            if ($spp && $spp->student_id != $request->student_id) {
                return redirect()->back()
                    ->withErrors(['spp_id' => 'The selected SPP does not belong to the chosen student.'])
                    ->withInput();
            }
        }

        try {
            // Update the payment
            $payment->update([
                'student_id' => $request->student_id,
                'spp_id' => $request->spp_id,
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
            ]);

            // Get student name for success message
            $student = Student::find($request->student_id);
            $studentName = $student ? $student->name : 'Unknown Student';

            return redirect()->route('admin.payments.index')
                ->with('success', "Payment for {$studentName} has been updated successfully.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update payment. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified payment from storage
     */
    public function destroy(Payment $payment)
    {
        try {
            $student = $payment->student;
            $studentName = $student ? $student->name : 'Unknown Student';
            $amount = $payment->amount_paid;

            $payment->delete();

            return redirect()->route('admin.payments.index')
                ->with('success', "Payment of Rp " . number_format($amount, 0, ',', '.') . " for {$studentName} has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete payment. Please try again.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
}
