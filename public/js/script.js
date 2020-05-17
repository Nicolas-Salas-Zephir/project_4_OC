
const menuToggle = () => {
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





const scrollFunction = () => {
    const mybutton = document.getElementById("backToTheTop");
  if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

window.onscroll = () => { scrollFunction() };
menuToggle();

