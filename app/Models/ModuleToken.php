<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleToken extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'token'
    ];

    public function User(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
