<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'national_id',
    ];

    ################################### START RELATIONS
    public function powerOfAttorneies()
    {
        return $this->hasMany(Procuration::class);
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    ################################### END RELATIONS
}
