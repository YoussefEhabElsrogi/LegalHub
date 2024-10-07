<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'reminder_time'];

    ################################### START RELATIONS

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    ################################### END RELATIONS

    protected $casts = ['reminder_time' => 'date'];
}   
