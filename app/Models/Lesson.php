<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'set_id',
        'name',
        'order'
    ];

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    public function contents()
    {
        return $this->hasMany(LessonContent::class, 'lesson_id', 'id');
    }

    public function scopeQuiz($query)
    {
        return $query->where('type', 'quiz');
    }

    
}
