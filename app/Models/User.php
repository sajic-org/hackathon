<?php

namespace App\Models;

use App\Enums\UserRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'workos_id',
        'avatar',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'workos_id',
        'password',
    ];

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar ?? null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return Gate::allows('is_admin') || Gate::allows('is_commission');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'password' => 'hashed',
        'verified_at' => 'datetime',
        'role' => UserRoles::class,
    ];

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }

    public function payment(): HasOneThrough
    {
        return $this->hasOneThrough(Payment::class, Registration::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
