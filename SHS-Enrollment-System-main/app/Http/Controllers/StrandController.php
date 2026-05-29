<?php

namespace App\Http\Controllers;

use App\Models\Strand;
use Illuminate\Http\Request;

class StrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Strand::query();
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('Strand_Name', 'LIKE', "%{$search}%");
        }
        
        $strands = $query->paginate(5);
        return view('strand.strand_list', compact('strands'));
    }

    public function create()
    {
        return view('strand.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Strand_Name' => 'required|unique:strands',
            'description' => 'required'
        ]);

        Strand::create($validated);
        return redirect()->route('strand.index')->with('success', 'Strand created successfully');
    }

    public function edit($id)
    {
        $strand = Strand::findOrFail($id);
        return view('strand.edit', compact('strand'));
    }

    public function update(Request $request, $id)
    {
        $strand = Strand::findOrFail($id);
        
        $validated = $request->validate([
            'Strand_Name' => 'required|unique:strands,Strand_Name,' . $id . ',StrandID',
            'description' => 'required'
        ]);

        $strand->update($validated);
        return redirect()->route('strand.strand_list')->with('success', 'Strand updated successfully');
    }


    public function destroy($id)
    {
        try {
            $strand = Strand::findOrFail($id);
            $strand->delete();
            
            return redirect()->route('strand.strand_list')
                ->with('success', 'Strand deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Delete failed. ' . $e->getMessage()]);
        }
    }
}