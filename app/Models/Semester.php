<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'admin_sem';
    protected $fillable = [
        'course_id',
        'semester_num',
        'max_cat',
        'category_id'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
