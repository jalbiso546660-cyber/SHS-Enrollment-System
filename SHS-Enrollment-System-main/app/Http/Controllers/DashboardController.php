<?php
namespace App\Http\Controllers;

use App\Models\students;
use App\Models\Strand;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for each strand
        $strandCounts = students::select('strands.Strand_Name', DB::raw('count(*) as total'))
            ->join('strands', 'students.StrandID', '=', 'strands.StrandID')
            ->groupBy('strands.Strand_Name')
            ->pluck('total', 'Strand_Name')
            ->toArray();

        // Initialize counts with 0 if no students
        $stemCount = $strandCounts['STEM'] ?? 0;
        $abmCount = $strandCounts['ABM'] ?? 0;
        $humssCount = $strandCounts['HUMSS'] ?? 0;

        return view('dashboard', compact('stemCount', 'abmCount', 'humssCount'));
    }
}
