<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonContent extends Model
{
    use HasFactory;
    
    protected $table = 'lesson_contents';
    
    protected $fillable = [
        'lesson_id',
        'type',
        'content',
        'order'
    ];

    public function options()
    {
        return $this->hasMany(Option::class, 'lesson_content_id', 'id');
    }

}
