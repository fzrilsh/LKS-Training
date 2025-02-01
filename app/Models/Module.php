<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Module extends Model
{
    protected $fillable = [
        'name',
        'category',
        'summary',
        'media_path',
        'exercise_path',
        'marking_path',
        'publisher_id',
    ];

    public function Publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function Marking(): HasOne
    {
        return $this->hasOne(ModuleMarking::class, 'module_id', 'id');
    }

    public function Tasks(): HasMany
    {
        return $this->hasMany(ModuleTask::class, 'module_id', 'id');
    }
}
