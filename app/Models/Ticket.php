<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'taker_id',
        'title',
        'device_number',
        'phone_number',
        'description',
        'post_file',
    ];
}
