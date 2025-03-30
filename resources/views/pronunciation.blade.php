@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🗣️ Ejercicios de Pronunciación</h1>

    @foreach($examples as $example)
        <div class="card mb-4">
            <div class="card-body">
                <h5>Frase a pronunciar:</h5>
                <p id="expected-{{ $example->id }}" class="fw-bold fs-5">{!! strip_tags($example->example) !!}</p>

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

<audio id="sound-start" src="{{ asset('sounds/start.mp3') }}"></audio>
<audio id="sound-success" src="{{ asset('sounds/success.mp3') }}"></audio>
<audio id="sound-error" src="{{ asset('sounds/error.mp3') }}"></audio>

<script>
function cleanText(text) {
    return text
        .replace(/[.,!?]/g, '') // elimina puntuación
        .replace(/\s+/g, ' ')   // normaliza espacios
        .trim()
        .toLowerCase();
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

    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';

    playSound('sound-start');
    document.getElementById('feedback-' + id).innerHTML = "🎧 Escuchando...";

    recognition.onresult = (event) => {
        const transcript = cleanText(event.results[0][0].transcript);
        document.getElementById('spokenText-' + id).innerText = `"${event.results[0][0].transcript}"`;

        if (transcript === expected) {
            document.getElementById('feedback-' + id).innerHTML = "✅ ¡Bien hecho!";
            playSound('sound-success');
        } else {
            document.getElementById('feedback-' + id).innerHTML = "❌ Intenta de nuevo.";
            playSound('sound-error');
        }
    };

    recognition.onerror = (event) => {
        document.getElementById('feedback-' + id).innerText = "❌ Error: " + event.error;
        playSound('sound-error');
    };

    recognition.start();
}
</script>
@endsection
