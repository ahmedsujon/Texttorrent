$(document).ready(function () {
  //Video Popup
  $(".modal_video_btn").modalVideo({
    youtube: {
      controls: 1,
      nocookie: true,
    },
  });
});

//OutSide Scroll Hidden
function scrollOutsideHidden() {
  let htmlTag = document.querySelector("html");
  htmlTag.style.cssText = "overflow:hidden;";
}
//OutSide Scroll Scroll
function scrollOutsideScroll() {
  let htmlTag = document.querySelector("html");
  htmlTag.style.cssText = "overflow:auto;";
}

//Sticky Navbar
function stickyHeader(stickyTag, stickyClass, scrollHeight = 0) {
  let stickyWrapper = document.querySelector(`#${stickyTag}`);
  stickyWrapper.classList.toggle(stickyClass, scrollY > scrollHeight);
}
let headerWrapper = document.querySelector("#headerWrapper");
if (headerWrapper) {
  window.addEventListener("scroll", () => {
    stickyHeader("headerWrapper", "navbar_fixed");
  });
}

// Mobile Menu
let navbarIcon = document.querySelector("#menuToggleBtn");
let navbarOverlay = document.querySelector("#mobileMenuOverlayArea");
let mobileMenuArea = document.querySelector("#mobileMenuListArea");
if (navbarIcon) {
  navbarIcon.addEventListener("click", () => {
    if (mobileMenuArea.classList.contains("active_mobile_menu")) {
      hideNavbar();
    } else {
      mobileMenuArea.classList.add("active_mobile_menu");
      navbarOverlay.style.cssText = "display:block";
      scrollOutsideHidden();
    }
  });
}

if (navbarOverlay) {
  navbarOverlay.addEventListener("click", () => {
    hideNavbar();
  });
}

function hideNavbar() {
  mobileMenuArea.classList.remove("active_mobile_menu");
  navbarOverlay.style.cssText = "display:none";
  scrollOutsideScroll();
}

// Unique  Menu
let uniqueListBtn = document.querySelector("#uniqueListBtn");
let uniqueMenuOverlay = document.querySelector("#uniqueMenuOverlay");
let uniqueListArea = document.querySelector("#uniqueListArea");
if (uniqueListBtn) {
  uniqueListBtn.addEventListener("click", () => {
    if (uniqueListArea.classList.contains("active_menu")) {
      hideUniqueNavbar();
    } else {
      uniqueListArea.classList.add("active_menu");
      uniqueMenuOverlay.style.cssText = "display:block";
      scrollOutsideHidden();
    }
  });
}

if (uniqueMenuOverlay) {
  uniqueMenuOverlay.addEventListener("click", () => {
    hideUniqueNavbar();
  });
}

function hideUniqueNavbar() {
  uniqueListArea.classList.remove("active_menu");
  uniqueMenuOverlay.style.cssText = "display:none";
  scrollOutsideScroll();
}

// Add focus and blur event listeners to inputs to control label floating
// const getAllInputFiled = document.querySelectorAll(".input_filed");
// if (getAllInputFiled) {
//   getAllInputFiled.forEach((input) => {
//     input.addEventListener("focus", () => {
//       input.classList.add("not-empty");
//     });

//     input.addEventListener("blur", () => {
//       if (input.value !== "") {
//         input.classList.add("not-empty");
//       } else {
//         input.classList.remove("not-empty");
//       }
//     });
//   });
// }



// AOS On Page Scroll JS
$(function () {
  AOS.init({
    duration: 1100,
    offest: 100,
    once: true,
  });
});
