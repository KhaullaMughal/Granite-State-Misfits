const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-items");

hamburger.addEventListener("click", () => {

    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");

});

document.querySelectorAll(".nav-items a").forEach(link => {

    link.addEventListener("click", () => {

        hamburger.classList.remove("active");
        navMenu.classList.remove("active");

    });

});


const slides = document.querySelector(".slides");

let counter = 0;

function autoSlide(){

    counter++;

    if(counter > 2){
        counter = 0;
    }

    slides.style.transform = `translateX(-${counter * 33.33}%)`;

}

setInterval(autoSlide, 3000); // Change every 3 seconds
