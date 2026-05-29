<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Strand;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Section::with(['strand', 'students.registration'])
                       ->withCount('students');

        if ($search) {
            $query->where('Section_Name', 'LIKE', "%{$search}%");
        }

        $sections = $query->paginate(5); 
        
        return view('sections.section_list', compact('sections'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('sections.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Section_Name' => 'required|string|max:255|unique:sections',
            'description' => 'nullable|string|max:255',
            'StrandID' => 'required|exists:strands,StrandID',
            'Grade_Level' => 'required|in:Grade 11,Grade 12'
        ]);

        Section::create($validated);
        return redirect()->route('sections.index')->with('success', 'Section created successfully');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $strands = Strand::all();
        return view('sections.edit', compact('section', 'strands'));
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        
        $validated = $request->validate([
            'Section_Name' => 'required|string|max:255|unique:sections,Section_Name,' . $id . ',SectionID',
            'StrandID' => 'required|exists:strands,StrandID',
            'Grade_Level' => 'required|in:Grade 11,Grade 12'
        ]);

        $section->update($validated);
        return redirect()->route('sections.section_list')->with('success', 'Section updated successfully');
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');
    }
}
