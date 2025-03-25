<div wire:poll.5000ms>
    <a href="#" title="Mensajes" class="relative text-gray-600 hover:text-blue-600 transition">
        @if ($unreadCount > 0)
        <div wire:poll.5000ms>
            <a href="#" title="Mensajes" class="relative text-gray-600 hover:text-blue-600 transition">
                <i class="bi bi-envelope-fill text-xl text-yellow-400 animate-pulse"></i>
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                    {{ $unreadCount }}
                </span>
            </a>
        </div>
    @endif
    </a>
</div>
