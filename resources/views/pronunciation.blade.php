@extends('layouts.app')

@section('title', 'Ejercicios de Pronunciación')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-2xl font-bold">🗣️ Ejercicios de Pronunciación</h1>

        @foreach ($lessons as $lesson)
            <div class="mb-5">
                <h2 class="text-xl font-bold text-blue-700 mb-3">{{ $lesson->title }}</h2>

                @foreach ($lesson->examples as $example)
                    @php
                        $pronounced =
                            auth()->check() &&
                            \App\Models\ExerciseResult::where('user_id', auth()->id())
                                ->where('example_id', $example->id)
                                ->where('pronoun', 1)
                                ->exists();
                    @endphp

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Frase a pronunciar:</h5>
                            <p id="expected-{{ $example->id }}" class="fw-bold fs-5">
                                {!! strip_tags($example->example) !!}
                                @if ($pronounced)
                                    <span class="text-success ms-2"><i class="bi bi-check-circle-fill"></i></span>
                                @endif
                            </p>

                            <div class="mb-2">
                                <button onclick="speak({{ $example->id }})" class="btn btn-outline-secondary me-2">
                                    🔊 Escuchar
                                </button>
                                <button onclick="startSpeech({{ $example->id }})" class="btn btn-primary">
                                    🎤 Pronunciar
                                </button>
                            </div>

                            <p id="spokenText-{{ $example->id }}" class="text-muted mb-1"></p>
                            <div id="feedback-{{ $example->id }}" class="fs-5"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        {{-- Paginación de Bootstrap --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $lessons->links('pagination::bootstrap-5') }}
        </div>

        <div class="text-center mt-8 mb-14">
            <a href="{{ route('courses.index') }}"
                class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                <i class="bi bi-arrow-left-circle-fill mr-2 text-xl"></i> Volver a Cursos
            </a>
        </div>
    </div>

    {{-- Audios --}}
    <audio id="sound-start" src="{{ asset('sounds/start.mp3') }}"></audio>
    <audio id="sound-success" src="{{ asset('sounds/success.mp3') }}"></audio>
    <audio id="sound-error" src="{{ asset('sounds/error.mp3') }}"></audio>

    {{-- Scripts --}}
    <script>
        function cleanText(text) {
            return text.replace(/[.,!?]/g, '').replace(/\s+/g, ' ').trim().toLowerCase();
        }

        function playSound(id) {
            const sound = document.getElementById(id);
            if (sound) sound.play();
        }

        function speak(id) {
            const text = document.getElementById('expected-' + id).innerText;
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'en-US';
            speechSynthesis.speak(utterance);
        }

        function startSpeech(id) {
            const expectedRaw = document.getElementById('expected-' + id).innerText;
            const expected = cleanText(expectedRaw);

            const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';

            playSound('sound-start');
            document.getElementById('feedback-' + id).innerHTML = "🎧 Escuchando...";

            recognition.onresult = (event) => {
                const transcript = cleanText(event.results[0][0].transcript);
                document.getElementById('spokenText-' + id).innerText = `"${event.results[0][0].transcript}"`;

                let status = 0;
                let feedback = "❌ Intenta de nuevo.";
                let sound = 'sound-error';

                if (transcript === expected) {
                    feedback = "✅ ¡Bien hecho!";
                    sound = 'sound-success';
                    status = 1;

                    // Mostrar check dinámico
                    const p = document.getElementById('expected-' + id);
                    if (!p.querySelector('i')) {
                        const icon = document.createElement('i');
                        icon.className = 'bi bi-check-circle-fill text-success ms-2';
                        p.appendChild(icon);
                    }
                }

                document.getElementById('feedback-' + id).innerHTML = feedback;
                playSound(sound);

                @auth
                fetch(`/save-pronunciation/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        status: status
                    })
                });
            @endauth
        };

      

        recognition.onerror = (event) => {
            document.getElementById('feedback-' + id).innerText = "❌ Error: " + event.error;
            playSound('sound-error');
        };

        recognition.start();
        }
    </script>
@endsection
