<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use App\Models\Message; // 👈 FALTABA ESTA LÍNEA

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'subscriber',
        'admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function unreadMessagesCount()
    {
        return Message::where('recipient_id', $this->id)
            ->whereNull('read_at')
            ->count();
    }
}
