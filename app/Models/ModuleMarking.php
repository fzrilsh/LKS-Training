<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleMarking extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'module_id',
        'json',
        'max_point',
    ];

    public function Module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
