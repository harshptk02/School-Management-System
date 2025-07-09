<?php

namespace App\Http\Controllers;

use App\Models\StudentFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $selectedClass = $request->query('class');
        $selectedStatus = $request->query('status');
        $selectedMonth = $request->query('month');

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Get all unique classes from student profiles
        $classes = \App\Models\StudentProfile::query()->distinct()->pluck('class')->filter()->values();

        $studentsQuery = User::where('role', 'student')->with('studentProfile');
        if ($selectedClass) {
            $studentsQuery->whereHas('studentProfile', function ($q) use ($selectedClass) {
                $q->where('class', $selectedClass);
            });
        }
        $students = $studentsQuery->get();

        $currentMonth = $selectedMonth ?: Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        // Get fee status for selected/current month for all students
        foreach ($students as $student) {
            $student->currentFeeStatus = StudentFee::getFeeStatus(
                $student->id,
                $currentMonth,
                $currentYear
            );
        }

        // Filter by status if requested
        if ($selectedStatus) {
            $students = $students->filter(function ($student) use ($selectedStatus) {
                if ($selectedStatus === 'not_generated') {
                    return $student->currentFeeStatus === 'not_generated';
                }
                return $student->currentFeeStatus === $selectedStatus;
            });
        }

        return view('admin.fees.index', [
            'students' => $students,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'classes' => $classes,
            'selectedClass' => $selectedClass,
            'selectedStatus' => $selectedStatus,
            'months' => $months,
            'selectedMonth' => $selectedMonth,
        ]);
    }

    public function show($studentId)
    {
        $student = User::findOrFail($studentId);
        $fees = StudentFee::where('student_id', $studentId)
                         ->orderBy('year', 'desc')
                         ->orderBy('month', 'desc')
                         ->get();

        return view('admin.fees.show', compact('student', 'fees'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->with('studentProfile')->get();
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return view('admin.fees.create', compact('students', 'months'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        // Check if fee already exists for this student/month/year
        $existingFee = StudentFee::where('student_id', $request->student_id)
                                ->where('month', $request->month)
                                ->where('year', $request->year)
                                ->first();

        if ($existingFee) {
            return redirect()->back()->with('error', 'Fee record already exists for this student for the selected month and year.');
        }

        StudentFee::create([
            'student_id' => $request->student_id,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'status' => 'pending',
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('admin.fees.index')
                         ->with('success', 'Fee record created successfully.');
    }

    public function edit($id)
    {
        $fee = StudentFee::findOrFail($id);
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return view('admin.fees.edit', compact('fee', 'months'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,paid',
            'due_date' => 'required|date',
            'payment_date' => 'nullable|date|required_if:status,paid',
            'payment_method' => 'nullable|string|required_if:status,paid',
            'transaction_id' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $fee = StudentFee::findOrFail($id);

        $fee->update([
            'amount' => $request->amount,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'payment_date' => $request->status == 'paid' ? $request->payment_date : null,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.fees.show', $fee->student_id)
                         ->with('success', 'Fee record updated successfully.');
    }

    public function generateMonthlyFees(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'class' => 'nullable|string',
        ]);

        $studentsQuery = User::where('role', 'student');
        if ($request->filled('class')) {
            $studentsQuery->whereHas('studentProfile', function ($q) use ($request) {
                $q->where('class', $request->class);
            });
        }
        $students = $studentsQuery->get();
        $count = 0;

        foreach ($students as $student) {
            // Check if fee already exists
            $existingFee = StudentFee::where('student_id', $student->id)
                                    ->where('month', $request->month)
                                    ->where('year', $request->year)
                                    ->first();

            if (!$existingFee) {
                StudentFee::create([
                    'student_id' => $student->id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'amount' => $request->amount,
                    'status' => 'pending',
                    'due_date' => $request->due_date,
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.fees.index')
                         ->with('success', "Generated fee records for {$count} students.");
    }

    public function markAsPaid($id)
    {
        $fee = StudentFee::findOrFail($id);

        $fee->update([
            'status' => 'paid',
            'payment_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Fee marked as paid successfully.');
    }

    public function downloadReceipt($feeId)
    {
        $fee = StudentFee::with('student.studentProfile')->findOrFail($feeId);
        if ($fee->status !== 'paid') {
            return redirect()->back()->with('error', 'Receipt can only be downloaded for paid fees.');
        }
        $data = [
            'fee' => $fee,
            'student' => $fee->student,
            'profile' => $fee->student->studentProfile,
        ];
        $pdf = Pdf::loadView('admin.fees.receipt', $data);
        $filename = 'Fee-Receipt-' . $fee->student->studentProfile->student_id . '-' . $fee->month . '-' . $fee->year . '.pdf';
        return $pdf->download($filename);
    }
}