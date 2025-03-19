let index = 0;
showSlide(index);

function showSlide(n) {
    let slides = document.getElementsByClassName("carousel-item");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    index = (n + slides.length) % slides.length;
    slides[index].style.display = "block";
}

function change(n) {
    showSlide(index + n);
}

function autoSlide() {
    change(1);
    setTimeout(autoSlide, 3000); // Change slide every 3 seconds
}

autoSlide();