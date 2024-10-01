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
    public function procuration()
    {
        return $this->hasMany(Procuration::class);
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    ################################### END RELATIONS
}
