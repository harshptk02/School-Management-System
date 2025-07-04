<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')
            ->with('teacherProfile')
            ->paginate(10);
        
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'employee_id' => 'required|string|unique:teacher_profiles',
            'subject' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'teacher',
                'email_verified_at' => now(),
            ]);

            TeacherProfile::create([
                'user_id' => $user->id,
                'employee_id' => $request->employee_id,
                'subject' => $request->subject,
                'qualification' => $request->qualification,
            ]);
        });

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    public function show(User $teacher)
    {
        $teacher->load('teacherProfile');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(User $teacher)
    {
        $teacher->load('teacherProfile');
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->id,
            'employee_id' => 'required|string|unique:teacher_profiles,employee_id,' . $teacher->teacherProfile->id,
            'subject' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $teacher) {
            $teacher->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $teacher->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $teacher->teacherProfile->update([
                'employee_id' => $request->employee_id,
                'subject' => $request->subject,
                'qualification' => $request->qualification,
            ]);
        });

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();
        
        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}