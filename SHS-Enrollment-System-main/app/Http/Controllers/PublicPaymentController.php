<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRegistration;
use App\Models\Payment;

class PublicPaymentController extends Controller
{
    public function public_create()
    {
        $students = StudentRegistration::where('current_status', 'Approved')->get();
        return view('public_payment.create', compact('students'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'RegistrationID' => 'required|exists:student_registration,RegistrationID',
                'Payment_Method' => 'required|in:Cash,GCash',
                'Reference_Number' => 'required|string|unique:payments',
                'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
            ]);

            if ($request->hasFile('receipt')) {
                $file = $request->file('receipt');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/receipts', $filename);
                $data['receipt'] = str_replace('public/', '', $path);
            }

            $data['Payment_Date'] = now();
            $data['Status'] = 'Pending';
            $data['Amount'] = 0; // Set initial amount to 0

            Payment::create($data);

            return redirect()->back()->with('success', 'Payment submitted successfully! Please wait for verification.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
