const pElt = document.querySelectorAll(".post-content");
const arr = pElt.split(" ").slice(0, 70).join(" ").toString();
pElt.textContent = arr;

