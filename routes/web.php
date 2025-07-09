<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\FeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
            default:
                return redirect()->route('login');
        }
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Teacher Management
    Route::resource('teachers', TeacherController::class, [
        'names' => [
            'index' => 'admin.teachers.index',
            'create' => 'admin.teachers.create',
            'store' => 'admin.teachers.store',
            'show' => 'admin.teachers.show',
            'edit' => 'admin.teachers.edit',
            'update' => 'admin.teachers.update',
            'destroy' => 'admin.teachers.destroy',
        ]
    ]);
    
    // Student Management
    Route::resource('students', StudentController::class, [
        'names' => [
            'index' => 'admin.students.index',
            'create' => 'admin.students.create',
            'store' => 'admin.students.store',
            'show' => 'admin.students.show',
            'edit' => 'admin.students.edit',
            'update' => 'admin.students.update',
            'destroy' => 'admin.students.destroy',
        ]
    ]);
    
    // Time Table Management
    Route::resource('timetables', TimeTableController::class, [
        'names' => [
            'index' => 'admin.timetables.index',
            'create' => 'admin.timetables.create',
            'store' => 'admin.timetables.store',
            'edit' => 'admin.timetables.edit',
            'update' => 'admin.timetables.update',
            'destroy' => 'admin.timetables.destroy',
        ]
    ])->except(['show']);
});

// Teacher Routes
Route::middleware(['auth', 'verified', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});

// Student Routes
Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

// Fee Management Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
    Route::get('/fees/create', [FeeController::class, 'create'])->name('fees.create');
    Route::post('/fees', [FeeController::class, 'store'])->name('fees.store');
    Route::get('/fees/{id}/edit', [FeeController::class, 'edit'])->name('fees.edit');
    Route::put('/fees/{id}', [FeeController::class, 'update'])->name('fees.update');
    Route::get('/fees/student/{studentId}', [FeeController::class, 'show'])->name('fees.show');
    Route::post('/fees/generate', [FeeController::class, 'generateMonthlyFees'])->name('fees.generate');
    Route::patch('/fees/{id}/mark-paid', [FeeController::class, 'markAsPaid'])->name('fees.mark-paid');
    Route::get('/fees/{fee}/receipt', [FeeController::class, 'downloadReceipt'])->name('fees.receipt');
});