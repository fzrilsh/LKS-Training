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

    protected $appends = ['module', 'grade'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function getModuleAttribute(){
        return $this->Module()->first();
    }

    public function getGradeAttribute(){
        $marking = collect(json_decode($this->json_marking, true));
        return $marking->reduce(fn($a, $b) => $a + $b['point']) . " point";
    }
}
