<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'user_id','story_id'];
    
    public function owner()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function story()
    {
      return $this->belongsTo(Story::class);
    }
}
