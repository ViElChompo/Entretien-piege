<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['story_id', 'title', 'content', 'is_ending', 'ending_type'];
    
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
    
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}