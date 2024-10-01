<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'expense_name',
        'amount',
        'notes'
    ];

    ################################### START RELATIONS
    public function client()
    {
        return  $this->belongsTo(Client::class);
    }
    ################################### END RELATIONS
}
