<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerOfAttorney extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'power_number',
        'registry_number',
        'national_id',
    ];

    
}