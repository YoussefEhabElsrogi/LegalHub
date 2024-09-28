<?php

namespace App\Models;

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

    ################################### START RELATIONS
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
    ################################### END RELATIONS
}
