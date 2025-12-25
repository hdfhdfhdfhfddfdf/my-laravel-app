<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
    'title', 'description', 'event_date', 'event_time', 
    'venue', 'image', 'category', 'price', 
    'total_tickets', 'available_tickets'
];
}
