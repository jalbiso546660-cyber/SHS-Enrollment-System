<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('FirstName', 'LIKE', "%{$search}%")->orWhere('LastName', 'LIKE', "%{$search}%");
        }
        
        $teachers = $query->get();
        return view('teachers.teacher_list', compact('teachers'));
    }
      

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|unique:teachers,Email',
            'Contact_Number' => 'required|string|max:20',
            'Address' => 'required|string',
            'DOB' => 'required|date',
            'Gender' => 'required|string|in:Male,Female,Other',
            'Subject_Specialization' => 'required|string|max:255',
        ]);

        Teacher::create($validated);
        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'MiddleName' => 'nullable|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|unique:teachers,Email,' . $id . ',TeacherID',
            'Contact_Number' => 'required|string|max:20',
            'Address' => 'required|string',
            'DOB' => 'required|date',
            'Gender' => 'required|string|in:Male,Female,Other',
            'Subject_Specialization' => 'required|string|max:255',
        ]);

        $teacher->update($validated);
        return redirect()->route('teachers.teacher_list')->with('success', 'Teacher updated successfully');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teachers.teacher_list')->with('success', 'Teacher deleted successfully');
    }
}