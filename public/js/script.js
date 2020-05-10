
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

// function commentStatement() {
//     let count = 0;
//     const stopComment = document.getElementById("stop-comment");
//     const pushStopComent = document.getElementById("push-stp-comment");

//     stopComment.addEventListener("click", () => {
//         if(count === 0) {
//             count += 1;
//             pushStopComent.value = count;
//         } else if(count === 1) {
//             count = 0;
//             pushStopComent.value = count;
//         }
//         console.log(pushStopComent.value)
//     });
// }

// commentStatement();
menuToggle();
