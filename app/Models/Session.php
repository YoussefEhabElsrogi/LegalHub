<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'session_type',
        'session_number',
        'opponent_name',
        'session_date',
        'session_status',
        'notes',
    ];
    protected $casts = ['session_date' => 'date'];
    ################################### START RELATIONS
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
    ################################### END RELATIONS
}
