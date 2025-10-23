<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResultDetail extends Model
{
    protected $fillable = [
        'exam_result_id',
        'column_name',
        'correct_count',
        'wrong_count',
        'total_answered',
        'score'
    ];

    public function examResult()
    {
        return $this->belongsTo(ExamResult::class);
    }
}
