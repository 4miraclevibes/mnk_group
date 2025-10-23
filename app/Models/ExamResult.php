<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = ['exam_subject_id', 'user_id', 'score', 'description'];

    public function examSubject()
    {
        return $this->belongsTo(ExamSubject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examResultDetails()
    {
        return $this->hasMany(ExamResultDetail::class);
    }
}


