<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Room;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['subject', 'teacher', 'section', 'room'])->paginate(5);
        return view('schedule.schedule_list', compact('schedules'));
    }

    public function create()
    {
        // Fetch all subjects, teachers, sections, and available rooms
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();
        $rooms = Room::where('is_available', true)->get();
        
        return view('schedule.create', compact('subjects', 'teachers', 'sections', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'SubjectID' => 'required|exists:subjects,SubjectID',
            'TeacherID' => 'required|exists:teachers,TeacherID',
            'SectionID' => 'required|exists:sections,SectionID',
            'RoomID' => 'required|exists:rooms,RoomID',
            'Day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'Start_Time' => 'required|date_format:H:i',
            'End_Time' => 'required|date_format:H:i|after:Start_Time'
        ]);

        Schedule::create($validated);
        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully');
    }

    public function edit($id)
    {
        // Fetch the schedule to be edited along with all subjects, teachers, sections, and rooms
        $schedule = Schedule::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();
        $rooms = Room::all();
        
        return view('schedule.edit', compact('schedule', 'subjects', 'teachers', 'sections', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the schedule to be updated
        $schedule = Schedule::findOrFail($id);
        
        $validated = $request->validate([
            'SubjectID' => 'required|exists:subjects,SubjectID',
            'TeacherID' => 'required|exists:teachers,TeacherID',
            'SectionID' => 'required|exists:sections,SectionID',
            'RoomID' => 'required|exists:rooms,RoomID',
            'Day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'Start_Time' => 'required|date_format:H:i',
            'End_Time' => 'required|date_format:H:i|after:Start_Time'
        ]);

        $schedule->update($validated);
        return redirect()->route('schedule.index')->with('success', 'Schedule updated successfully');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Schedule deleted successfully');
    }
}