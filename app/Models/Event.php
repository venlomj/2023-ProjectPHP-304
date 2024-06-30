<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_date', 'end_date'];

    public function user_attendances()
    {
        return $this->hasMany(UserAttendance::class);
    }
}
