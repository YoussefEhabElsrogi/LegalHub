<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CompanyFoundation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
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
    ################################### END RELATIONS
}
