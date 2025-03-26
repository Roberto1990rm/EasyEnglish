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

    protected $listeners = ['loadMoreMessages','deleteConversation']; // 🧠 Escucha evento del scroll


   

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
    if (trim($this->message) === '') return;

    $user = auth()->user();
    $this->loadUsers(); // asegúrate de que los usuarios están cargados (por si acaso)

    // ✅ Caso: no logueado → respuesta de EasyBot (sin guardar)
    if (!$user) {
        $this->messages[] = (object)[
            'user_id' => null,
            'sender' => (object)['name' => 'EasyBot', 'admin' => true],
            'content' => '👋 Para hablar con nuestros profesores necesitas <a href="' . route('register') . '" class="text-blue-600 underline">registrarte aquí</a>.',
            'created_at' => now(),
            'read_at' => now(),
        ];
        $this->message = '';
        return;
    }

    // ⚠️ Usuario logado pero NO suscriptor y está intentando hablar con un ADMIN
    $recipient = $this->recipientId ? User::find($this->recipientId) : null;
    if ($user && !$user->subscriber && !$user->admin) {
        if ($recipient && $recipient->admin) {
            $this->messages[] = (object)[
                'user_id' => null,
                'sender' => (object)['name' => 'EasyBot', 'admin' => true],
                'content' => '🛑 Para chatear con nuestros profesores necesitas una suscripción. <a href="' . route('subscribe') . '" class="text-blue-600 underline">Suscríbete aquí</a> 😊',
                'created_at' => now(),
                'read_at' => now(),
            ];
            $this->message = '';
            return;
        }

        // Evitar que hable con otros usuarios que no sean admin
        if (!$recipient || !$recipient->admin) {
            $this->messages[] = (object)[
                'user_id' => null,
                'sender' => (object)['name' => 'EasyBot', 'admin' => true],
                'content' => '🚫 Solo puedes hablar con administradores si estás suscrito.',
                'created_at' => now(),
                'read_at' => now(),
            ];
            $this->message = '';
            return;
        }
    }

    // ✅ Usuario suscriptor o admin → mensaje real
    Message::create([
        'user_id' => $user->id,
        'recipient_id' => $this->recipientId,
        'content' => $this->message,
    ]);

    $this->message = '';
}

    
public function addBotMessage($text)
{
    Message::create([
        'user_id' => null, // sin user_id
        'recipient_id' => auth()->id(), // va dirigido al usuario actual
        'content' => $text,
    ]);
}

public function mount()
{
    $this->loadUsers();

    if (auth()->check() && $this->recipientId) {
        $this->loadMessages();
    }
}

public function loadMessages()
{
    $this->messages = Message::where(function ($q) {
        $q->where('user_id', auth()->id())
          ->where('recipient_id', $this->recipientId);
    })->orWhere(function ($q) {
        $q->where('user_id', $this->recipientId)
          ->where('recipient_id', auth()->id());
    })
    ->orderBy('created_at', 'asc')
    ->get();
}

    public function deleteConversation()
{
    if (!$this->recipientId) return;

    Message::where(function ($q) {
        $q->where('user_id', auth()->id())
          ->where('recipient_id', $this->recipientId);
    })->orWhere(function ($q) {
        $q->where('user_id', $this->recipientId)
          ->where('recipient_id', auth()->id());
    })->delete();

    $this->reset('message'); // limpia el input
}


public function render()
{
    if (auth()->check() && $this->recipientId && auth()->user()->subscriber) {
        $this->loadMessages();
    }

    return view('livewire.chat-component');
}


    
}
