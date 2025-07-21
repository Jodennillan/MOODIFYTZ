<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'title', 
        'content', 
        'entry_date', 
        'privacy'
    ];
    
    protected $casts = [
        'entry_date' => 'date'
    ];
}
