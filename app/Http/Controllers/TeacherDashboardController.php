<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalStudents = User::where('role', 'student')->count();
        $teacherProfile = auth()->user()->teacherProfile;

        // Get all unique class-section pairs the teacher teaches
        $classSections = \App\Models\TimeTable::where('teacher_id', auth()->id())
            ->select('class', 'section')
            ->distinct()
            ->get();

        // Get selected class/section from request or default to first
        $selectedClass = $request->input('class', $classSections->first()->class ?? null);
        $selectedSection = $request->input('section', $classSections->first()->section ?? null);

        // Get timetable for selected class/section
        $timetables = null;
        if ($selectedClass && $selectedSection) {
            $timetables = \App\Models\TimeTable::where('class', $selectedClass)
                ->where('section', $selectedSection)
                ->orderBy('day')
                ->orderBy('start_time')
                ->get();
        }

        return view('teacher.dashboard', compact('totalStudents', 'teacherProfile', 'classSections', 'selectedClass', 'selectedSection', 'timetables'));
    }
}