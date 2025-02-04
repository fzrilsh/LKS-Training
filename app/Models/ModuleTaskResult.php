<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleTaskResult extends Model
{
    protected $fillable = [
        'module_task_id',
        'user_id',
        'total_point',
    ];

    public function ModuleTask(): BelongsTo
    {
        return $this->belongsTo(ModuleTask::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
