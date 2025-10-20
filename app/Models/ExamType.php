<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = ['test_category_id', 'name', 'token', 'status', 'section'];

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function testCategory()
    {
        return $this->belongsTo(TestCategory::class);
    }

    public function examSubjects()
    {
        return $this->hasMany(ExamSubject::class);
    }
}
