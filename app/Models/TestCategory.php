<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestCategory extends Model
{
    protected $fillable = ['name'];

    public function examTypes()
    {
        return $this->hasMany(ExamType::class);
    }
}
