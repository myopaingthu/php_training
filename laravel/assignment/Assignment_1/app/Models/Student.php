<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'dob',
        'major_id'
    ];

    /**
     * Get the major that owns the student.
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
