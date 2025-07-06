<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'subject',
        'qualification',
        'profile_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}