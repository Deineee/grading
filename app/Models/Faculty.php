<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\UserStatus;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'status',
        'semester_id',
        'semester_name',
        'department_id',
        'department_name',
    ];

    /**
     * Get the user associated with the faculty member.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Automatically set related details before saving.
     */
    protected static function booted()
    {
        static::saving(function ($faculty) {
            if ($faculty->user_id) {
                $user = User::find($faculty->user_id);
                if ($user) {
                    $faculty->name = $user->name;
                    $faculty->email = $user->email;
                    $faculty->status = $user->status;
                }
            }

            if ($faculty->semester_id) {
                $semester = Semester::find($faculty->semester_id);
                if ($semester) {
                    $faculty->semester_name = $semester->name;
                }
            }

            if ($faculty->department_id) {
                $department = Department::find($faculty->department_id);
                if ($department) {
                    $faculty->department_name = $department->department;
                }
            }
        });
    }

    /**
     * Get the semester associated with the faculty member.
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * Get the department associated with the faculty member.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    protected $casts = [
        'status' => UserStatus::class,
    ];
}
