<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'google_id',
        'name',
        'email',
        'avatar_url',
    ];

    protected $appends = [
        'module_tasks',
        'module_token',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function ModuleTasks(): HasMany
    {
        return $this->hasMany(ModuleTask::class);
    }

    public function ModuleToken(): HasOne
    {
        return $this->hasOne(ModuleToken::class);
    }

    public function uploadedAssets(): HasMany
    {
        return $this->hasMany(UploadedAsset::class);
    }

    public function getModuleTasksAttribute()
    {
        return $this->ModuleTasks()->get();
    }

    public function getModuleTokenAttribute()
    {
        return $this->ModuleToken()->first();
    }
}
