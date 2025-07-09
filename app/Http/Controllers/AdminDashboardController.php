<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\StudentFee;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStudents = User::where('role', 'student')->count();

// Users by Day Chart - Modified for Daily Grouping
$usersChart = new LaravelChart([
    'chart_title' => 'User Registrations by Day',
    'report_type' => 'group_by_date',
    'model' => 'App\Models\User',
    'group_by_field' => 'created_at',
    'group_by_period' => 'day', // Changed from 'month' to 'day'
    'chart_type' => 'bar', // Valid: line/bar/pie only
    'filter_field' => 'created_at',
    'filter_days' => 30, // Show last 30 days for daily view
    'chart_color' => '75,85,99',
    'background_color' => 'rgba(75,85,99,0.2)',
    'border_color' => 'rgba(75,85,99,1)',
    'filter_period' => 'month', // Show current month's data
    'aggregate_function' => 'count',
    'chart_height' => 400,
    'continuous_time' => true, // Fill gaps in timeline
]);

// Users by Role Chart - Enhanced
$roleChart = new LaravelChart([
    'chart_title' => 'User Distribution by Role',
    'report_type' => 'group_by_string',
    'model' => 'App\Models\User',
    'group_by_field' => 'role',
    'chart_type' => 'pie', // Valid: line/bar/pie only
    'chart_color' => '55,65,81',
    'colors' => ['#4B5563', '#3B82F6', '#16688A', '#14532D'],
    'aggregate_function' => 'count',
    'chart_height' => 300,
    'where_raw' => 'role IS NOT NULL', // Exclude null roles
]);

$notifications = Notification::where('expires_at', '>', now())
        ->orderBy('created_at', 'desc')
        ->get();

    $totalFeeCollection = StudentFee::where('status', 'paid')->sum('amount');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalTeachers',
            'totalStudents',
            'usersChart',
            'roleChart',
            'notifications',
            'totalFeeCollection'
        ));
    }
}