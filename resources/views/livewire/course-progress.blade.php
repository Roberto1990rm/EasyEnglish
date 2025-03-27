<!-- resources/views/livewire/course-progress.blade.php -->
<div wire:poll.5s class="mt-4 text-center">
    <p class="text-gray-600 mb-2">Progreso del curso</p>
    <div class="flex justify-center items-center space-x-2">
        @for ($i = 0; $i < $totalLessons; $i++)
            <div class="w-5 h-5 rounded-full {{ $i < $completedLessons ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
        @endfor
        <div class="text-xl ml-2">🏃</div>
    </div>
    <p class="text-sm text-gray-500 mt-1">
        {{ round($percentage) }}% completado ({{ $completedLessons }} de {{ $totalLessons }})
    </p>
</div>

