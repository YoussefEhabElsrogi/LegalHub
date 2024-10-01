<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'establishment_fees',
        'fees',
        'remaining_amount',
        'advance_amount',
        'notes',
    ];

    ################################### START RELATIONS
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    ################################### END RELATIONS
}
