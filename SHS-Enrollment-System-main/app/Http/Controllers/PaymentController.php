<?php

namespace App\Http\Controllers;
use App\Models\Strand;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Students;
use App\Models\Section;
use App\Models\Room;
use App\Models\Subject;
use App\Mail\PaymentApproved;
use Illuminate\Support\Facades\Mail;
use App\Models\Schedule;

class PaymentController extends Controller
{
    public function __construct() {
        if (!Auth::check()) {
            redirect('/login')->send();
        }
        
    }
    // List all payments
    public function Payment_list(Request $request)
    {
        // ma access ra Cashier and Admin
        $user = Auth::user();
        if ($user->role !== 'Cashier' && $user->role !== 'Admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $query = Payment::query();
        //search bar
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('PaymentID', 'LIKE', "%{$search}%");
        }
        
        $payments = $query->paginate(5); 
        return view('Payment.Payment_list', compact('payments'));
    }

    public function cashier_create()
    {
        $students = StudentRegistration::where('current_status', 'Approved')->get();
        return view('Payment.cashier_create', compact('students'));
    }
//store info
    public function cashier_store(Request $request)
    {
        try {
            $data = $request->validate([
                'RegistrationID' => 'required|exists:student_registration,RegistrationID',
                'Payment_Method' => 'required|in:Cash,GCash',
                'Amount' => 'required|numeric',
                'Reference_Number' => 'required|string|unique:payments',
                'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
            ]);
            // para sa receipt
            if ($request->hasFile('receipt')) {
                $file = $request->file('receipt');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/receipts', $filename);
                $data['receipt'] = str_replace('public/', '', $path);
            }

            $data['Payment_Date'] = now();
            $data['Status'] = 'Pending';

            Payment::create($data);

            return redirect()->back()->with('success', 'Payment submitted successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $students = StudentRegistration::where('current_status', 'Approved')->get();
        return view('Payment.edit', compact('payment', 'students'));
    }

    public function update(Request $request, $id)
    {
        try {
            $payment = Payment::with('registration')->findOrFail($id);
            
            if ($request->has('Status')) {
                $registration = $payment->registration;
                
                // Update payment status
                $payment->Status = $request->Status;
                $payment->save();

                if ($request->Status === 'Completed') {
                   // mag assign strand ug section randomly pinaka first na naa sa database
                    $strand = Strand::where('Strand_Name', $registration->Strand)->first();
                    $section = Section::where('StrandID', $strand->StrandID)->where('Grade_Level', $registration->GradeLevel)->first();
                   // assign room based sa strand ug grade level
                    $room = Room::where('StrandID', $strand->StrandID)->where('Grade_Level', $registration->GradeLevel)->where('is_available', true)->inRandomOrder()->first();

                if (!$room) {
                    throw new \Exception('No available rooms for this strand and grade level');
                }
                    // after ma change ang status into "Completed" mag Create student record then ma past sa student table
                    $student = Students::create([
                        'RegistrationID' => $registration->RegistrationID,
                        'DOB' => $registration->DOB,
                        'Gender' => $registration->Gender,
                        'Address' => $registration->Address,
                        'ContactNo' => $registration->ContactNo,
                        'Email' => $registration->Email,
                        'GradeLevel' => $registration->GradeLevel,
                        'StrandID' => $strand->StrandID,
                        'SectionID' => $section->SectionID,
                        'RoomID' => $room->RoomID
                    ]);

                     // assign subjects based sa strand ug grade level
                    $subjects = Subject::where('StrandID', $strand->StrandID)->where('Grade_Level', $registration->GradeLevel)->get();

                    // Get subjects with their schedules
                    $subjects = Subject::where('StrandID', $strand->StrandID)->where('Grade_Level', $registration->GradeLevel)->with(['schedules' => function($query) use ($section) {
                    $query->where('SectionID', $section->SectionID);}])->get();

                    // after ma create ang data sa student table mag send sya sa email sa student based sa email nga naa sa registration table
                    Mail::to($registration->Email)->send(new PaymentApproved($payment, $registration, $section, $strand, $room, $subjects));

                    return redirect()->route('students_payment.Payment_list')->with('success', 'Payment approved and student enrolled successfully');
                }
            } else {
                // This is a payment details update
                $validated = $request->validate([
                    'RegistrationID' => 'required|exists:student_registration,RegistrationID',
                    'Payment_Method' => 'required|in:Cash,Gcash',
                    'Amount' => 'required|numeric',
                    'Reference_Number' => 'required|unique:payments,Reference_Number,' . $id . ',PaymentID',
                    'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
                ]);

                // Handle file upload if new receipt is provided
                if ($request->hasFile('receipt')) {
                    // Delete old receipt if exists
                    if ($payment->receipt && Storage::disk('public')->exists($payment->receipt)) {
                        Storage::disk('public')->delete($payment->receipt);
                    }

                    // Store new receipt
                    $file = $request->file('receipt');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('receipts', $filename, 'public');
                    $payment->receipt = $path;
                }

                // Update payment details
                $payment->RegistrationID = $validated['RegistrationID'];
                $payment->Payment_Method = $validated['Payment_Method'];
                $payment->Amount = $validated['Amount'];
                $payment->Reference_Number = $validated['Reference_Number'];
                $payment->save();

                return redirect()->route('students_payment.Payment_list')
                    ->with('success1', 'Payment details updated successfully');
            }

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
        
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();
            return redirect()->route('students_payment.Payment_list')->with('success_destroy', 'Payment deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to delete payment.']);
        }
    }

}
