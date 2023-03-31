const hamburger = document.querySelector(".hamburger");
const topLineHam = document.querySelector(".ham-logo");
const bottomLineHam = document.querySelector(".ham-bottom-line");
const navbar = document.querySelector(".nav-container");

hamburger.addEventListener("click", () => {
    topLineHam.classList.toggle("ham-log-rotate");
    bottomLineHam.classList.toggle("ham-bottom-line-rotate");
    navbar.classList.toggle("nav-container-toggle");
  });