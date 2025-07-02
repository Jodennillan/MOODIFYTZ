<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapistMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'from_therapist'
    ];

    // Sender is either user or therapist
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Receiver is the therapist or user
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

