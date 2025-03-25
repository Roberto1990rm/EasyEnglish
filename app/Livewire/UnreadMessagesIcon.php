<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;

class UnreadMessagesIcon extends Component
{
    public $unreadCount = 0;

    public function getUnreadCount()
    {
        $this->unreadCount = Message::where('recipient_id', auth()->id())
            ->whereNull('read_at')
            ->count();
    }

    public function render()
{
    $this->getUnreadCount();

    return view('livewire.unread-messages-icon', [
        'unreadCount' => $this->unreadCount,
    ]);
}
}
