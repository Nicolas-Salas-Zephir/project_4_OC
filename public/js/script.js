
function menuToggle() {
    const toggleHamburger = document.getElementById("hamburger-toggle");
    const nav = document.querySelector(".nav-hamburger");
    const cross = document.querySelector(".cross");

    toggleHamburger.addEventListener("click", () => {
        nav.classList.toggle("showw");
        toggleHamburger.classList.toggle("showw");
        cross.classList.toggle("showw");
    })

    cross.addEventListener("click", () => {
        nav.classList.toggle("showw");
        toggleHamburger.classList.toggle("showw");
        cross.classList.toggle("showw");
    })
}
menuToggle();
