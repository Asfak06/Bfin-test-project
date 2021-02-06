<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Story extends Model
{
    // use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
      'title', 'story', 'image_cap', 'image', 'listed', 'section_id', 'user_id'
    ];

    public function hasTag($tagId)
    {
      return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function section()
    {
      return $this->belongsTo(Section::class);
    }

    public function tags()
    {
      return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
