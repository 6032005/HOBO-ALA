let currentIndex = 0;
const slides = document.querySelectorAll('.carousel .slider > *');
const totalSlides = slides.length;

function showSlide(index) {
    const slideWidth = slides[0].clientWidth;
    document.querySelector('.carousel .slider').style.transform = `translateX(-${index * slideWidth}px)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
}


setInterval(nextSlide, 5000); 


let cardContainers = [...document.querySelectorAll('.card-container')];
    let preBtns = [...document.querySelectorAll('.pre-btn')];
    let nxtBtns = [...document.querySelectorAll('.nxt-btn')];

    cardContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtns[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth - 200;
        })

        preBtns[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth + 200;
        })
    })
    