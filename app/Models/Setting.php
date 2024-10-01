<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['facebook', 'instagram', 'twitter', 'app_name'];

    ################################### START RELATIONS

    ################################### END RELATIONS
}
