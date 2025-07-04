<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminProfile;
use App\Models\TeacherProfile;
use App\Models\StudentProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        AdminProfile::create([
            'user_id' => $admin->id,
            'employee_id' => 'ADM001',
            'department' => 'Administration',
        ]);

        // Create Teacher
        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'email_verified_at' => now(),
        ]);

        TeacherProfile::create([
            'user_id' => $teacher->id,
            'employee_id' => 'TCH001',
            'subject' => 'Mathematics',
            'qualification' => 'M.Sc Mathematics',
        ]);

        // Create Student
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);

        StudentProfile::create([
            'user_id' => $student->id,
            'student_id' => 'STU001',
            'class' => '10th',
            'section' => 'A',
            'admission_date' => now()->subYear(),
        ]);
    }
}