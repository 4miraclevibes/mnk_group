<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    protected $fillable = ['exam_type_id', 'name'];

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
}
