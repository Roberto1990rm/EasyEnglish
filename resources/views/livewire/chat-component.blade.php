<div style="margin-bottom: 18px;" x-data="{ open: false }" class="fixed bottom-4 right-4 z-50" @click.outside="open = false">
    <!-- Botón para minimizar/expandir -->
    <button @click="open = !open"
        class="bg-blue-600 text-white px-3 py-2 rounded-t-md shadow-md hover:bg-blue-700 transition">
        <i x-show="!open" class="bi bi-chat-left-text-fill"></i>
        <i x-show="open" class="bi bi-x-lg"></i>
    </button>

    <!-- Ventana del chat -->
    <div x-show="open" x-transition class="bg-white w-80 h-[450px] flex flex-col shadow-lg rounded-b-lg border border-gray-300">

        <!-- Selector de destinatario -->
        <div class="p-2 border-b bg-gray-100 relative" x-data="{ openSearch: false }" @click.outside="openSearch = false">
            @if(auth()->check() && auth()->user()->admin)
                <label for="searchUser" class="text-sm font-bold text-gray-600">Buscar alumno:</label>
                <input type="text"
                    id="searchUser"
                    wire:model.debounce.500ms="search"
                    @focus="openSearch = true"
                    placeholder="Buscar por nombre..."
                    class="w-full mt-1 border rounded text-sm p-1">

                <div x-show="openSearch" x-transition class="absolute bg-white z-50 w-full max-h-48 overflow-y-auto border rounded shadow mt-1">
                    @forelse($filteredUsers as $user)
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer flex justify-between items-center"
                             wire:click="$set('recipientId', {{ $user->id }})" @click="openSearch = false">
                            <span>{{ $user->name }}</span>
                            <span>
                                @if($user->admin) 👩‍🏫 @endif
                                {{ $user->isOnline() ? '🟢' : '🔴' }}
                            </span>
                        </div>
                    @empty
                        <div class="px-3 py-2 text-gray-500">No se encontraron resultados</div>
                    @endforelse
                </div>

                <label for="recipient" class="text-sm font-bold text-gray-600 mt-2 block">Conversaciones activas:</label>
                <select wire:model="recipientId" id="recipient" class="w-full mt-1 border rounded text-sm p-1">
                    <option value="">-- Selecciona un usuario --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                            @if($user->admin) 👩‍🏫 @endif
                            @if($user->unreadMessagesFromAuthUser()) ● @endif
                            {{ $user->isOnline() ? '🟢' : '🔴' }}
                        </option>
                    @endforeach
                </select>
            @else
                <label for="recipient" class="text-sm font-bold text-gray-600">Enviar a:</label>
                <select wire:model="recipientId" id="recipient" class="w-full mt-1 border rounded text-sm p-1">
                    <option value="">-- Selecciona un usuario --</option>
                    @foreach ($users as $user)
                        @continue($user->id === optional(auth()->user())->id)
                        @if (!optional(auth()->user())->admin && !$user->admin)
                            @continue
                        @endif
                        <option value="{{ $user->id }}">
                            {{ $user->name }} @if($user->admin) 👩‍🏫 @endif
                            {{ $user->isOnline() ? '🟢' : '🔴' }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <!-- Mensajes -->
        <div wire:poll.8000ms x-data="{
            isFirstLoad: true,
            init() {
                const el = $refs.scroll;
                Livewire.hook('message.processed', (message, component) => {
                    if (this.isFirstLoad || message.updateQueue[0]?.method === 'sendMessage') {
                        this.scrollToBottom();
                        this.isFirstLoad = false;
                    }
                });
                el.addEventListener('scroll', () => {
                    if (el.scrollTop === 0) {
                        Livewire.dispatch('loadMoreMessages');
                    }
                });
            },
            scrollToBottom() {
                const el = $refs.scroll;
                setTimeout(() => {
                    el.scrollTop = el.scrollHeight;
                }, 50);
            }
        }" x-init="init" x-ref="scroll" class="flex-1 overflow-y-auto p-2 space-y-2 text-sm bg-white">
            @foreach ($this->messages as $msg)
                @if (is_null($msg->user_id))
                    <!-- Mensaje del bot -->
                    <div class="bg-yellow-100 text-gray-800 p-2 rounded text-sm">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/easybot.png') }}" class="w-6 h-6 rounded-full" alt="Bot">
                            <strong>EasyBot</strong>
                        </div>
                        <div class="mt-1">{!! $msg->content !!}</div>
                    </div>
                @else
                    <!-- Mensaje normal -->
                    <div class="p-2 rounded {{ $msg->user_id === auth()->id() ? 'bg-blue-100 text-right' : 'bg-gray-100 text-left' }}">
                        <strong>{{ $msg->sender->name }}
                            @if ($msg->sender->admin)
                                <span class="text-yellow-500">(Admin)</span>
                            @endif
                        </strong>
                        <p class="text-gray-700">{!! $msg->content !!}</p>
                        <div class="text-[11px] text-gray-500 mt-1 flex items-center justify-end gap-1">
                            <span class="font-semibold">{{ $msg->created_at->format('H:i') }}</span>
                            @if ($msg->user_id === auth()->id())
                                @if ($msg->read_at)
                                    <i class="bi bi-check2-all text-blue-500"></i>
                                @else
                                    <i class="bi bi-check2 text-gray-400"></i>
                                @endif
                            @else
                                @if ($msg->read_at)
                                    <i class="bi bi-check2-all text-green-500"></i>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="text-center p-2 border-t bg-gray-100">
                <button
                    onclick="if (confirm('¿Estás seguro de que quieres eliminar toda la conversación? Esta acción no se puede deshacer.')) { Livewire.dispatch('deleteConversation') }"
                    class="text-red-600 text-sm hover:underline">
                    🗑️ Eliminar conversación
                </button>
            </div>
        </div>

        <!-- Input para escribir mensaje -->
        <form wire:submit.prevent="sendMessage" class="p-2 border-t bg-gray-50 flex">
            <input type="text" wire:model="message" class="flex-1 px-2 py-1 text-sm border rounded"
                placeholder="Escribe tu mensaje...">
            <button type="submit" class="ml-2 text-blue-600 font-bold">Enviar</button>
        </form>
    </div>
</div>