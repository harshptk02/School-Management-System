<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->with('studentProfile')
            ->paginate(10);
        
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'student_id' => 'required|string|unique:student_profiles',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'admission_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'email_verified_at' => now(),
            ]);

            StudentProfile::create([
                'user_id' => $user->id,
                'student_id' => $request->student_id,
                'class' => $request->class,
                'section' => $request->section,
                'admission_date' => $request->admission_date,
            ]);
        });

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(User $student)
    {
        $student->load('studentProfile');
        return view('admin.students.show', compact('student'));
    }

    public function edit(User $student)
    {
        $student->load('studentProfile');
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->id,
            'student_id' => 'required|string|unique:student_profiles,student_id,' . $student->studentProfile->id,
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'admission_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $student) {
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $student->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $student->studentProfile->update([
                'student_id' => $request->student_id,
                'class' => $request->class,
                'section' => $request->section,
                'admission_date' => $request->admission_date,
            ]);
        });

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(User $student)
    {
        $student->delete();
        
        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}