<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Strand;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Room::query();
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('Room_Number', 'LIKE', "%{$search}%")
                  ->orWhere('Building', 'LIKE', "%{$search}%");
        }
        
        $rooms = $query->paginate(5);
        return view('room.room_list', compact('rooms'));
    }

    public function create()
    
    {
        $strands = Strand::all();
        return view('room.create', compact('strands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Room_Number' => 'required|unique:rooms',
            'Building' => 'required',
            'Floor' => 'required',
            'Room_Type' => 'required|in:Classroom,Laboratory,Faculty Room,Other',
            'Capacity' => 'required|integer|min:1'
        ]);

        Room::create($validated);
        return redirect()->route('room.room_list')->with('success', 'Room created successfully');
    }

    public function edit($id)
    {   
        $room = Room::findOrFail($id);
        $strands = Strand::all();
        return view('room.edit', compact('room', 'strands'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'Room_Number' => 'required|unique:rooms,Room_Number,' . $id . ',RoomID',
            'Building' => 'required',
            'Floor' => 'required',
            'Room_Type' => 'required|in:Classroom,Laboratory,Faculty Room,Other',
            'Capacity' => 'required|integer|min:1'
        ]);

        $room->update($validated);
        return redirect()->route('room.room_list')->with('success', 'Room updated successfully');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('room.room_list')->with('success', 'Room deleted successfully');
    }
}