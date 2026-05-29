<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Strand;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $query = Subject::with('strand');
        
        if (request()->has('search')) {
            $search = request()->get('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }
        
        $subjects = $query->paginate(5); 
        return view('subjects.subjects_list', compact('subjects'));
    }

    public function create()
    {
        $strands = Strand::all();
        return view('subjects.create', compact('strands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'StrandID' => 'required|exists:strands,StrandID',
            'Semester' => 'required|in:1st Semester,2nd Semester',
            'School_Year' => 'required',
            'Grade_Level' => 'required|in:Grade 11,Grade 12',
            'description' => 'nullable'
        ]);

        Subject::create($validated);
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $strands = Strand::all();
        return view('subjects.edit', compact('subject', 'strands'));
    }
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required',
            'StrandID' => 'required|exists:strands,StrandID',
            'Semester' => 'required|in:1st Semester,2nd Semester',
            'School_Year' => 'required',
            'Grade_Level' => 'required|in:Grade 11,Grade 12',
            'description' => 'nullable'
        ]);

        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }
}