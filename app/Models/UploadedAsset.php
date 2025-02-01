<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadedAsset extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'path',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
