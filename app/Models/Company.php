<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'company_name',
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

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    ################################### END RELATIONS

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($company) {
            foreach ($company->files as $file) {
                FileService::deleteFile($file->path, 'uploads');
            }
            $company->files()->delete();
        });
    }
}
