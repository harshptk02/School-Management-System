<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $fillable = [
        'student_id',
        'month',
        'year',
        'amount',
        'status',
        'due_date',
        'payment_date',
        'payment_method',
        'transaction_id',
        'remarks'
    ];

    protected $casts = [
        'due_date' => 'date',
        'payment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Get all pending fees for a student
    public static function getPendingFees($studentId)
    {
        return self::where('student_id', $studentId)
                   ->where('status', 'pending')
                   ->orderBy('year')
                   ->orderBy('month')
                   ->get();
    }

    // Get all paid fees for a student
    public static function getPaidFees($studentId)
    {
        return self::where('student_id', $studentId)
                   ->where('status', 'paid')
                   ->orderBy('year')
                   ->orderBy('month')
                   ->get();
    }

    // Get fee status for a specific month and year
    public static function getFeeStatus($studentId, $month, $year)
    {
        $fee = self::where('student_id', $studentId)
                   ->where('month', $month)
                   ->where('year', $year)
                   ->first();

        return $fee ? $fee->status : 'not_generated';
    }
}