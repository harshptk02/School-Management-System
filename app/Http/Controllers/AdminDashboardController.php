<?php

namespace App\Http\Controllers;

use App\Models\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStudents = User::where('role', 'student')->count();

        // Add chart configurations
        $usersChart = new LaravelChart([
            'chart_title' => 'Users by Month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ]);

        $roleChart = new LaravelChart([
            'chart_title' => 'Users by Role',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'role',
            'chart_type' => 'pie',
        ]);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalTeachers',
            'totalStudents',
            'usersChart',
            'roleChart'
        ));
    }
}