let currentIndex = 0;

function updateCarousel() {
    const track = document.getElementById('carousel-track');
    const wrapper = document.getElementById('carousel-wrapper');
    if (!track || !wrapper) return;

    const cards = track.children;
    if (!cards.length) return;

    const width = cards[0].offsetWidth;
    track.style.transform = `translateX(-${currentIndex * width}px)`;

    const currentCard = cards[currentIndex];
    if (currentCard) {
        // Buscar el primer hijo con contenido dentro del slide
        const inner = currentCard.querySelector('.bg-white');
        if (inner) {
            wrapper.style.height = `${inner.offsetHeight}px`;
        }
    }
}




document.addEventListener('DOMContentLoaded', () => {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const track = document.getElementById('carousel-track');
    const cards = track ? track.children : [];
    const total = cards.length;

    if (prevBtn)
        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

    if (nextBtn)
        nextBtn.addEventListener('click', () => {
            if (currentIndex < total - 1) {
                currentIndex++;
                updateCarousel();
            }
        });

    updateCarousel();
    window.addEventListener('resize', updateCarousel);
});

function goToSlide(index) {
    currentIndex = index;
    updateCarousel();
}

// Modal de imágenes
function openModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('modalImage');
    if (modal && img) {
        img.src = imageSrc;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });
    }
});

// Pronunciación
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

// Hacer funciones accesibles desde Blade
window.goToSlide = goToSlide;
window.openModal = openModal;
window.closeModal = closeModal;
window.speak = speak;
window.startSpeech = startSpeech;
