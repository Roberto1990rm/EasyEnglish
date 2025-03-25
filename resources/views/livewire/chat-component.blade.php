<div style="margin-bottom: 18px;" x-data="{ open: false }" class="fixed bottom-4 right-4 z-50">
    <!-- Botón para minimizar/expandir -->
    <button @click="open = !open"
        class="bg-blue-600 text-white px-3 py-2 rounded-t-md shadow-md hover:bg-blue-700 transition">
        <i x-show="!open" class="bi bi-chat-left-text-fill"></i>
        <i x-show="open" class="bi bi-x-lg"></i>
    </button>



    
    <!-- Ventana del chat -->
    <div x-show="open" class=" bg-white w-80 h-[450px] flex flex-col shadow-lg rounded-b-lg border border-gray-300">

        <!-- Selector de destinatario -->
        <div class="p-2 border-b bg-gray-100">
            <label for="recipient" class="text-sm font-bold text-gray-600">Enviar a:</label>
            <select wire:model="recipientId" id="recipient" class="w-full mt-1 border rounded text-sm p-1">
                <option value="">-- Selecciona un usuario --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                        @if ($user->admin)
                            (Admin)
                        @endif
                        @if ($user->isOnline())
                            🟢
                        @else
                            🔴
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Mensajes -->
        <!-- Mensajes con scroll inteligente -->
        <div wire:poll.3000ms x-data="{
            isFirstLoad: true,
            init() {
                const el = $refs.scroll;
        
                // Scroll al fondo solo al inicio o cuando envías algo nuevo
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
        }" x-init="init" x-ref="scroll"
            class="flex-1 overflow-y-auto p-2 space-y-2 text-sm bg-white">
            @foreach ($this->messages as $msg)
                <div
                    class="p-2 rounded {{ $msg->user_id === auth()->id() ? 'bg-blue-100 text-right' : 'bg-gray-100 text-left' }}">
                    <strong>{{ $msg->sender->name }}
                        @if ($msg->sender->admin)
                            <span class="text-yellow-500">(Admin)</span>
                        @endif
                    </strong>
                    <p class="text-gray-700">
                        {{ $msg->content }}
                    </p>

                    <div class="text-[11px] text-gray-500 mt-1 flex items-center justify-end gap-1">
                        <span class="font-semibold">{{ $msg->created_at->format('H:i') }}</span>

                        @if ($msg->user_id === auth()->id())
                            {{-- Mensaje enviado por mí --}}
                            @if ($msg->read_at)
                                <i class="bi bi-check2-all text-blue-500"></i> {{-- leído --}}
                            @else
                                <i class="bi bi-check2 text-gray-400"></i> {{-- enviado pero no leído --}}
                            @endif
                        @else
                            {{-- Mensaje recibido --}}
                            @if ($msg->read_at)
                                <i class="bi bi-check2-all text-green-500"></i> {{-- yo lo leí --}}
                            @endif
                        @endif
                    </div>



                </div>
            @endforeach
            <!-- Botón para eliminar conversación -->
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
