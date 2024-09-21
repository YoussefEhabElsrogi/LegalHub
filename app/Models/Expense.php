<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'case',
        'expense_name',
        'amount',
        'notes'
    ];

    ################################### START RELATIONS

    ################################### END RELATIONS
}
