<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject'; 
    
    protected $fillable = [
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

}
