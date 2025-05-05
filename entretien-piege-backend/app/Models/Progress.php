<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{

    protected $table = 'progresses';
    protected $fillable = ['user_id', 'story_id', 'current_chapter_id', 'choices_made'];
    
    protected $casts = [
        'choices_made' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
    
    public function currentChapter()
    {
        return $this->belongsTo(Chapter::class, 'current_chapter_id');
    }
}