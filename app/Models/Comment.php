<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modell: Comment
 *
 * Repräsentiert einen Kommentar zu einem Beitrag.
 * Ein Kommentar gehört zu einem Benutzer und einem Beitrag
 * und kann als Antwort auf einen anderen Kommentar erstellt werden.
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }
}
