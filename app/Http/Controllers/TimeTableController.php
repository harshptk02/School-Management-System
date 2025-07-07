<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    public function index(Request $request)
    {
        $query = TimeTable::with('teacher');
        
        if ($request->has('class')) {
            $query->where('class', $request->class);
        }
        
        $timeTables = $query->paginate(15);
        return view('admin.timetables.index', compact('timeTables'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.timetables.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
            'day' => 'required|string|max:20',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        TimeTable::create($request->all());
        return redirect()->route('admin.timetables.index')->with('success', 'Time table entry created successfully.');
    }

    public function edit(TimeTable $timetable)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.timetables.edit', compact('timetable', 'teachers'));
    }

    public function update(Request $request, TimeTable $timetable)
    {
        $request->validate([
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
            'day' => 'required|string|max:20',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $timetable->update($request->all());
        return redirect()->route('admin.timetables.index')->with('success', 'Time table entry updated successfully.');
    }

    public function destroy(TimeTable $timetable)
    {
        $timetable->delete();
        return redirect()->route('admin.timetables.index')->with('success', 'Time table entry deleted successfully.');
    }
}
