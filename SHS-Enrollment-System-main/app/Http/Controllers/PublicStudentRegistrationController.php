<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class PublicStudentRegistrationController extends Controller
{
    public function student_register_Form(Request $request)
    {
        $query = StudentRegistration::query();
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('RegistrationID', 'LIKE', "%{$search}%");
        }
        
        $registrations = $query->get();
        
        return view('public_registration.student_register', compact('registrations'));
    }

    public function student_register()
    {
        return view('public_student.student_register');
    }


    public function store(Request $request)
    {
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
                'Form138' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);

            if ($request->hasFile('Form138')) {
                $filePath = $request->file('Form138')->store('form138', 'public');
                $data['Form138'] = $filePath;
            }

            $data['application_date'] = now();
            $data['current_status'] = 'Pending';

            $student =StudentRegistration::create($data);
            if ($student) {
                return back()->with('success', 'Registration submitted successfully!');
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
