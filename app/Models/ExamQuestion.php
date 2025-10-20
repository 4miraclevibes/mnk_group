<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = ['exam_subject_id', 'question', 'image'];

    public function examSubject()
    {
        return $this->belongsTo(ExamSubject::class);
    }

    public function examAnswers()
    {
        return $this->hasMany(ExamAnswer::class);
    }
}
