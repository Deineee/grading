<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semester';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'school_name',
        'school_id',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Example relationship: A Semester can have many Grades.
     
    public function grades()
    {
        return $this->hasMany(Grade::class);
    } */

    /**
     * Example relationship: A Semester can have many Subjects.
     
     public function subjects()
    {
        return $this->hasMany(Subject::class);
    } */
}
