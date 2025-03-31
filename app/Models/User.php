<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use App\Models\Message;

class User extends Authenticatable
{
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
            'subscription_ends_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function unreadMessagesFromAuthUser()
    {
        return Message::where('recipient_id', auth()->id())
            ->where('user_id', $this->id)
            ->whereNull('read_at')
            ->exists();
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
    
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }
    

}
