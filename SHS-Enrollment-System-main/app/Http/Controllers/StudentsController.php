<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\Strand;
use App\Models\Section;
use App\Models\Registration;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public function index(Request $request)
    {
        $query = students::with(['registration', 'strand', 'section']);
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('StudentID', 'LIKE', "%{$search}%")
                  ->orWhereHas('registration', function($q) use ($search) {
                      $q->where('FirstName', 'LIKE', "%{$search}%")
                        ->orWhere('LastName', 'LIKE', "%{$search}%");
                  });
        }
        
        $students = $query->paginate(5);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $strands = Strand::all();
        $students = StudentRegistration::where('current_status', 'Approved')->get();
        $sections = Section::all();
        
        return view('students.create', compact('students', 'strands', 'sections'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'RegistrationID' => 'required|exists:student_registration,RegistrationID',
            'DOB' => 'required|date',
            'Gender' => 'required|in:Male,Female,Other',
            'Address' => 'required|string|max:255',
            'ContactNo' => 'required|string|max:255',
            'Email' => 'required|email|unique:students,Email',
            'StrandID' => 'required|exists:strands,StrandID',
            'GradeLevel' => 'required|in:Grade 11,Grade 12',
            'SectionID' => 'required|string|max:255',
        ]);
        
        students::create($validated);
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function edit($id)
    {
        $student = students::findOrFail($id);
        $strands = Strand::all();
        $students = students::findOrFail($id);
        return view('students.edit', compact('students', 'strands'));
    }
    public function update(Request $request, $id)
    {
        $student = students::findOrFail($id);
        
        $validated = $request->validate([
            'RegistrationID' => 'required|exists:student_registration,RegistrationID',
            'DOB' => 'required|date',
            'Gender' => 'required|in:Male,Female,Other',
            'Address' => 'required|string|max:255',
            'ContactNo' => 'required|string|max:255',
            'Email' => 'required|email|unique:students,Email',
            'StrandID' => 'required|exists:strands,StrandID',
            'GradeLevel' => 'required|in:Grade 11,Grade 12',
            'SectionID' => 'required|string|max:255',
        ]);
        
        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id)
    {
        $student = students::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function searchStudent(Request $request)
    {
        try {
            $studentId = $request->input('student_id');
            
            $student = Students::with(['registration', 'strand', 'section'])
                ->where('StudentID', $studentId)
                ->where('GradeLevel', 'Grade 11')
                ->first();

            if (!$student) {
                return back()->with('error', 'Student not found or not in Grade 11');
            }

            return view('public_student.old_student_registration', compact('student'));

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    
    }

