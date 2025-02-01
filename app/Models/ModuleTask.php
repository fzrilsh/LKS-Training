<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ModuleTask extends Model
{
    protected $fillable = [
        'user_id',
        'module_id',
        'status',
        'json_marking',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function Result(): HasOne
    {
        return $this->hasOne(ModuleTaskResult::class, 'module_id', 'id');
    }
}
