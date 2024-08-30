<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programs';

    protected $fillable = [
        'program_name',
        'program_description',
        'department_id',
    ];

    // A program has many subjects
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    // A program is belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
