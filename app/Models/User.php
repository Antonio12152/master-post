<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * Modell: User
 *
 * Repräsentiert einen Benutzer der Anwendung.
 * Ein Benutzer kann mehrere Beiträge (posts) und Kommentare (comments) erstellen.
 * Enthält außerdem Logik zum automatischen Hashen des Passworts beim Setzen.
 */

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'description',
        'password',
        'type'
    ];
    protected $hidden = [
        'password',
    ];
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
