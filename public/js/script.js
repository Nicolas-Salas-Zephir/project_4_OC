
const toggleHamburger = document.getElementById("hamburger-toggle");
const nav = document.querySelector(".nav-hamburger");
const cross = document.querySelector(".cross");

toggleHamburger.addEventListener("click", () => {
    nav.classList.toggle("show");
    toggleHamburger.classList.toggle("show");
    cross.classList.toggle("show");
})

cross.addEventListener("click", () => {
    nav.classList.toggle("show");
    toggleHamburger.classList.toggle("show");
    cross.classList.toggle("show");
})

