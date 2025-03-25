<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;

class ChatComponent extends Component
{
    public $message = '';
    public $recipientId = null;
    public $users;
    public $messageLimit = 6;

    protected $listeners = ['loadMoreMessages']; // 🧠 Escucha evento del scroll

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::where('id', '!=', auth()->id())
            ->get()
            ->sortByDesc(fn($u) => $u->admin)
            ->sortByDesc(fn($u) => $u->isOnline());
    }

    public function getMessagesProperty()
    {
        if (!$this->recipientId) return collect();

        // Marcar como leídos los que van llegando
        Message::where('user_id', $this->recipientId)
            ->where('recipient_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return Message::where(function ($q) {
                $q->where('user_id', auth()->id())
                  ->where('recipient_id', $this->recipientId);
            })->orWhere(function ($q) {
                $q->where('user_id', $this->recipientId)
                  ->where('recipient_id', auth()->id());
            })
            ->orderBy('created_at', 'desc') // Cargamos desde los más recientes
            ->take($this->messageLimit)
            ->get()
            ->reverse(); // Y los invertimos para mostrarlos desde el más antiguo de los cargados
    }

    public function sendMessage()
    {
        if (!$this->recipientId || trim($this->message) === '') return;

        \Log::info('Enviando mensaje...', [
            'user_id' => auth()->id(),
            'recipient_id' => $this->recipientId,
            'content' => $this->message,
        ]);

        Message::create([
            'user_id' => auth()->id(),
            'recipient_id' => $this->recipientId,
            'content' => $this->message,
        ]);

        $this->message = '';
    }

    // 📦 Aumentar el límite de mensajes al hacer scroll
    public function loadMoreMessages()
    {
        $this->messageLimit += 3;
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
