const toggleHamburger = document.getElementById("hamburger-toggle");

const menuToggle = () => {
  const nav = document.querySelector(".nav-hamburger");
  const cross = document.querySelector(".cross");

  toggleHamburger.addEventListener("click", () => {
    nav.classList.toggle("showw");
    toggleHamburger.classList.toggle("showw");
    cross.classList.toggle("showw");
  });

  cross.addEventListener("click", () => {
    nav.classList.toggle("showw");
    toggleHamburger.classList.toggle("showw");
    cross.classList.toggle("showw");
  });
};

window.addEventListener("scroll", () => {
  const scroll = document.querySelector(".backToTheTop");
  scroll.classList.toggle("activeScroll", window.scrollY > 500)
});

const scrollToTop = () => {
  const scroll = document.querySelector(".backToTheTop");
  scroll.addEventListener("click", () => {
    window.scrollTo( {
      top: 0,
      behavior: 'smooth'
    })
  })
}

if(toggleHamburger) {
  menuToggle();
}
scrollToTop();
