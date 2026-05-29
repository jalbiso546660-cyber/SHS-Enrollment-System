<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function __construct() {
        if (!Auth::check()) {
            redirect('/login')->send();
        }
        
    }

    public function index(Request $request)
    {
        //ma access ra Registrar ug Admin
        $user = Auth::user();
        if ($user->role !== 'Registrar' && $user->role !== 'Admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $query = StudentRegistration::query();
        //search bar 
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('RegistrationID', 'LIKE', "%{$search}%");
        }
        
        $registrations = $query->paginate(5);
        
        return view('students_registration.index', compact('registrations'));
    }

    public function create()
    {
        return view('students_registration.create');
    }

    public function store(Request $request)
    {
        // Validate then store ang data sa table
        try {
            $data = $request->validate([
                'FirstName' => 'required|string|max:50',
                'MiddleName' => 'nullable|string|max:50',
                'LastName' => 'required|string|max:50',
                'DOB' => 'required|date',
                'Gender' => 'required|string|in:Male,Female,Other',
                'Address' => 'required|string',
                'ContactNo' => 'required|string|max:15',
                'Email' => 'required|string|email|max:100|unique:student_registration',
                'Strand' => 'required|string|in:STEM,ABM,HUMSS',
                'GradeLevel' => 'required|string|in:Grade 11,Grade 12',
                'FatherFullName' => 'required|string|max:100',
                'MotherFullName' => 'required|string|max:100',
                'FatherContactNo' => 'required|string|max:15',
                'MotherContactNo' => 'required|string|max:15',
                'Form138' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
            //Form 138 file upload
            if ($request->hasFile('Form138')) {
                $filePath = $request->file('Form138')->store('public/form138');
                $data['Form138'] = str_replace('public/', '', $filePath);
            }

            $data['Status'] = 'Pending';
            
            StudentRegistration::create($data);

            return redirect()->route('students_registration.index')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Registration failed. ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $registration = StudentRegistration::findOrFail($id);
        return view('students_registration.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        try {
            $registration = StudentRegistration::findOrFail($id);
            
            if ($request->has('current_status')) {
                $data = ['current_status' => $request->current_status];
                //if current status is approved mag send nag email na approved ang student based sa iyang email
                //then update ang approved date
                switch ($request->current_status) {
                    case 'Approved':
                        $data['approved_date'] = now();
                        $data['rejected_date'] = null;
                        try {
                            Mail::to($registration->Email)->send(new TestMail($registration));
                           
                        } catch (\Exception $e) {
                            return back()->withInput()->withErrors(['error' => 'Email sending failed. ' . $e->getMessage()]);
                        }
                        break;

                    case 'Rejected':
                        $data['rejected_date'] = now();
                        $data['approved_date'] = null;
                        break;

                    default:
                        $data['approved_date'] = null;
                        $data['rejected_date'] = null;
                        break;
                }
                
                $registration->update($data);
                
                $statusMessage = $request->current_status == 'Approved' ? 'approved' : 'rejected';
                return redirect()->route('students_registration.index')
                    ->with('success', "Registration has been {$statusMessage} successfully");
            }
            // Validate the other fields
            // if wala nag change ang status, validate ang other fields
            // then update ang data sa table
            $data = $request->validate([
                'FirstName' => 'required|string|max:50',
                'MiddleName' => 'nullable|string|max:50',
                'LastName' => 'required|string|max:50',
                'DOB' => 'required|date',
                'Gender' => 'required|string|in:Male,Female,Other',
                'Address' => 'required|string',
                'ContactNo' => 'required|string|max:15',
                'Email' => 'required|string|email|max:100|unique:student_registration,Email,' . $id . ',RegistrationID',
                'GradeLevel' => 'required|string|in:Grade 11,Grade 12',
                'Strand' => 'required|string|in:STEM,ABM,HUMSS',
                'FatherFullName' => 'required|string|max:100',
                'MotherFullName' => 'required|string|max:100',
                'FatherContactNo' => 'required|string|max:15',
                'MotherContactNo' => 'required|string|max:15',
                'Form138' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
                'Status' => 'required|string|in:Pending,Approved,Rejected'
            ]);
            // Form 138 file upload
            if ($request->hasFile('Form138')) {
                $file = $request->file('Form138');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('form138', $fileName, 'public');
                $data['Form138'] = $filePath;
            }
            
            $registration->update($data);
            
            return redirect()->route('students_registration.index')
                ->with('success', 'Registration updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Update failed. ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $registration = StudentRegistration::findOrFail($id);
            $registration->delete();
            
            return redirect()->route('students_registration.index')
                ->with('success', 'Registration deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Delete failed. ' . $e->getMessage()]);
        }
    }
}



