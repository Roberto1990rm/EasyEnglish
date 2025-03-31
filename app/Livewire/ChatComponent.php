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
    public $search = '';
    public $filteredUsers = [];

    protected $listeners = ['loadMoreMessages', 'deleteConversation'];

    public function loadUsers()
    {
        $auth = auth()->user();
    
        if ($auth->admin) {
            // Admin: mostrar solo admins y usuarios con los que ya haya conversación
            $this->users = User::where('id', '!=', $auth->id)
                ->where(function ($query) use ($auth) {
                    $query->where('admin', true)
                        ->orWhereHas('sentMessages', function ($q) use ($auth) {
                            $q->where('recipient_id', $auth->id);
                        })
                        ->orWhereHas('receivedMessages', function ($q) use ($auth) {
                            $q->where('user_id', $auth->id);
                        });
                })
                ->get()
                ->sortByDesc(fn($u) => $u->isOnline());
        } else {
            // Usuario normal: solo admins
            $this->users = User::where('admin', true)
                ->where('id', '!=', $auth->id)
                ->get()
                ->sortByDesc(fn($u) => $u->isOnline());
        }
    }
    

    public function getMessagesProperty()
    {
        if (!$this->recipientId) return collect();

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
            ->orderBy('created_at', 'desc')
            ->take($this->messageLimit)
            ->get()
            ->reverse();
    }

    public function updatedSearch()
    {
        if (auth()->user()->admin && strlen($this->search) > 1) {
            $this->filteredUsers = User::where('name', 'like', '%' . $this->search . '%')
                ->where('id', '!=', auth()->id())
                ->get();
        }
    }

    public function sendMessage()
    {
        if (trim($this->message) === '') return;

        $user = auth()->user();
        $this->loadUsers();

        if (!$user) {
            $this->messages[] = (object)[
                'user_id' => null,
                'sender' => (object)['name' => 'EasyBot', 'admin' => true],
                'content' => '👋 Para hablar con nuestros administradores necesitas <a href="' . route('register') . '" class="text-blue-600 underline">registrarte aquí</a>.',
                'created_at' => now(),
                'read_at' => now(),
            ];
            $this->message = '';
            return;
        }

        if (!$this->recipientId) {
            $this->messages[] = (object)[
                'user_id' => null,
                'sender' => (object)['name' => 'EasyBot', 'admin' => true],
                'content' => '⚠️ Por favor selecciona un profesor antes de enviar tu mensaje.',
                'created_at' => now(),
                'read_at' => now(),
            ];
            $this->message = '';
            return;
        }

        $recipient = User::find($this->recipientId);

        if (!$recipient) {
            $this->messages[] = (object)[
                'user_id' => null,
                'sender' => (object)['name' => 'EasyBot', 'admin' => true],
                'content' => '❌ No se ha encontrado el usuario al que intentas escribir.',
                'created_at' => now(),
                'read_at' => now(),
            ];
            $this->message = '';
            return;
        }

        if (!$user->subscriber && !$user->admin) {
            if ($recipient->admin) {
                $this->messages[] = (object)[
                    'user_id' => null,
                    'sender' => (object)['name' => 'EasyBot', 'admin' => true],
                    'content' => '🛑 Para chatear con los administradores necesitas estar registrado y suscrito <a href="' . route('subscribe') . '" class="text-blue-600 underline">suscripción</a> 😊',
                    'created_at' => now(),
                    'read_at' => now(),
                ];
                $this->message = '';
                return;
            }

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

        Message::create([
            'user_id' => $user->id,
            'recipient_id' => $recipient->id,
            'content' => $this->message,
        ]);

        $this->message = '';
    }

    public function loadMoreMessages()
    {
        $this->messageLimit += 3;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->recipientId) return;

        Message::where('user_id', $this->recipientId)
            ->where('recipient_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->messages = Message::where(function ($q) {
            $q->where('user_id', auth()->id())
                ->where('recipient_id', $this->recipientId);
        })->orWhere(function ($q) {
            $q->where('user_id', $this->recipientId)
                ->where('recipient_id', auth()->id());
        })
            ->orderBy('created_at', 'desc')
            ->take($this->messageLimit)
            ->get()
            ->reverse();
    }

    public function addBotMessage($text)
    {
        Message::create([
            'user_id' => null,
            'recipient_id' => auth()->id(),
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

        $this->reset('message');
    }

    public function render()
    {
        if (auth()->check() && $this->recipientId && auth()->user()->subscriber) {
            $this->loadMessages();
        }

        return view('livewire.chat-component');
    }
}