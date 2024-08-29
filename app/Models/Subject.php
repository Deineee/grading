<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects'; 
    
    protected $fillable = [
        'user_id',
        'department_id',
        'subject_name',
        'subject_description',
        'subject_code',
        'credits'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relationship to prerequisite subjects
    // Use this method when you want to find all the prerequisite subjects for a given subject.
    public function prerequisites()
    {
        return $this->belongsToMany(Subject::class, 'subject_prerequisite', 'subject_id', 'prerequisite_subject_id') -> withTimestamps();
    }

    // Relationship to subjects that have this subject as their prerequisite
    // Use this method when you want to find all the subjects that list a given subject as their prerequisite.
    public function dependentSubjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_prerequisite', 'prerequisite_subject_id', 'subject_id') -> withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }



}
