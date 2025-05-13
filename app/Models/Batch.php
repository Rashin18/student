<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    // Add the 'name', 'course_id', and 'start_date' fields to the fillable array

    protected $fillable = ['name', 'course_id', 'start_date', 'teacher_id'];


    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function students() {
        return $this->hasMany(Student::class);
    }
    public function course()
{
    return $this->belongsTo(Course::class);
}

}