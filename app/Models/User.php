<?php

namespace App\Models;


use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasAvatar, FilamentUser {
    use SoftDeletes;
    use  Notifiable;
    use HasRoles, HasPanelShield, TwoFactorAuthenticatable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'phone',
        'phone_country',
        'is_active',
        'is_archived',
        'sales',
        'team_leader',
        'user_team',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_team' => 'array',
    ];

    public function getFilamentAvatarUrl(): ?string {
        return $this->avatar_url ? Storage::disk('root_folder')->url($this->avatar_url) : null;
    }
}
