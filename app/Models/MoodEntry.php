<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodEntry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mood','note' ,'time_period', 'intensity', 'entry_date','mood_value', 'triggers', 'emoji'];

    protected $casts = [
    'entry_date' => 'date',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
