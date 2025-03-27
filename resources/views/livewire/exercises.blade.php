<div class="mt-6" x-data="{ submitted: @entangle('submitted') }">
    <h3 class="text-xl font-bold text-green-600 mb-4">Ejercicios</h3>

    <form wire:submit.prevent="submit" class="space-y-4">
        @foreach ($lesson->examples as $example)
            @php
                $masked = str_replace($example->solution, '_____', strip_tags($example->example));
            @endphp

            <div class="bg-gray-100 p-4 rounded shadow">
                <p class="mb-2 text-gray-800">Completa: <strong>{{ $masked }}</strong></p>

                <input 
                    type="text"
                    wire:model.defer="answers.{{ $example->id }}"
                    class="border px-3 py-1 rounded w-40"
                    placeholder="Escribe la palabra"
                    @if($completed) disabled @endif
                >

                @if(isset($results[$example->id]))
                    @if($results[$example->id])
                        <span class="ml-2 text-green-600 font-bold">✅</span>
                    @else
                        <span class="ml-2 text-red-600 font-bold">❌</span>
                    @endif
                @endif

                <p class="text-gray-600 mt-1"><em>Traducción:</em> {!! $example->translation !!}
                </p>
            </div>
        @endforeach

        @if($completed)
            <div class="text-green-600 font-semibold mt-4">🎉 ¡Ejercicio completado correctamente!</div>
            <button wire:click.prevent="retry" class="mt-2 text-blue-600 hover:underline">Rehacer ejercicio</button>
        @else
            <button type="submit"
                class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Enviar respuestas
            </button>
        @endif
    </form>
</div>
