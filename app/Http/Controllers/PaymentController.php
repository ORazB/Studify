<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Student;
use App\Models\Spp;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\Parameter;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $student_id = $request->query('student_id');
        $payments = Payment::where('student_id', $student_id)->get();

        return view('payments.index', compact('payments', 'student_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $studentId = $request->student_id;
        $sppId = $request->spp_id;
        $sppNominal = $request->amount_paid;

        return view('payments.create', compact('studentId', 'sppId', 'sppNominal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        // Handle file upload first
        $paymentProofPath = null;
        if ($request->hasFile('foto')) {
            $paymentProofPath = $request->file('foto')->store('payments', 'public');
        }

        // Create the payment
        Payment::create([
            'student_id' => $request->student_id,
            'spp_id' => $request->spp_id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
            'image' => $paymentProofPath,
            'status' => 'pending'
        ]);

        Spp::findOrFail($request->spp_id)->update([
            'status' => 'pending'
        ]);

        // Get student name for success message
        $student = Student::find($request->student_id);
        $studentName = $student ? $student->name : 'Unknown Student';

        return redirect()->route('students.index')
            ->with('success', "Payment of Rp " . number_format($request->amount_paid, 0, ',', '.') . " for {$studentName} has been recorded successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load(['student', 'spp']);
        return view('payments.show', compact('payment'));
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

        $status = $request->status;
        $spp = Spp::findOrFail($payment->spp_id);

        // Update the payment
        if ($status == 'approved') {
            $payment->update([
                'status' => 'paid',
            ]);

            // Update the related SPP
            $spp->update([
                'status' => 'paid'
            ]);
        } else {
            $payment->update([
                'status' => 'disapproved',
            ]);

            // Update the related SPP
            $spp->update([
                'status' => null
            ]);
        }

        return redirect()->route('admin.payments.index');
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
