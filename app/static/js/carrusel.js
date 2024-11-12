let currentIndex = 0;

function moveSlide(direction) {
    const slides = document.getElementById("carouselSlides");
    const totalSlides = slides.children.length;

    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}