<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $studentProfile = auth()->user()->studentProfile;
        
        return view('student.dashboard', compact('studentProfile'));
    }
}