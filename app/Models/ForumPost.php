<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'tags',
        'anonymous',
    ];

    protected $casts = [
        'tags' => 'array',
        'anonymous' => 'boolean',
         'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
{
    return $this->hasMany(ForumReply::class);
}



public function likes()
{
    return $this->hasMany(ForumLike::class);
}

public function isLikedBy($user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}



}
