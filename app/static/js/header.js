const header = document.querySelector('.main-header');

// Escucha el evento de scroll
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) { // Si el usuario ha bajado más de 50px
        header.classList.add('scrolled-header');
    } else {
        header.classList.remove('scrolled-header');
    }
});