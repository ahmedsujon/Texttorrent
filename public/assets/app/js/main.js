$(document).ready(function () {
  //Nice Select
  $(".niceSelect").niceSelect();

  //Status condition
  const getStatusEl = $("#statusRow");
  const statusSelect = $("#statusSelect");
  if (getStatusEl) {
    statusSelect.change(function (e) {
      e.preventDefault();
      const getSelectValue = statusSelect.val();
      if (getSelectValue === "1") {
        getStatusEl.removeClass("inactive");
      } else {
        getStatusEl.addClass("inactive");
      }
    });
  }

  //Gallery
  // $(".gallery_popup").magnificPopup({
  //   type: "image",
  //   gallery: {
  //     enabled: true,
  //   },
  // });

  //Sidebar Functionality
  const closeSidebarBtnEl = $("#sidebarCloseBtn");
  const openSidebarBtnEl = $(".sidebar_open_btn");
  $(closeSidebarBtnEl).click(function (e) {
    e.preventDefault();

    if (window.innerWidth >= 992) {
      $("body").toggleClass("short_sidebar_active");
      $(openSidebarBtnEl).css("display", "flex");
    } else {
      $("body").toggleClass("hide-sidebar");
      $("#sidebarOverlay").slideToggle();
      $("html,body").css("overflow-y", "auto");
    }
  });
  $(openSidebarBtnEl).click(function (e) {
    e.preventDefault();
    if (window.innerWidth >= 992) {
      $("body").toggleClass("short_sidebar_active");
      $(openSidebarBtnEl).hide();
    } else {
      $("body").toggleClass("hide-sidebar");
      $("#sidebarOverlay").slideToggle();
      $("html,body").css("overflow-y", "hidden");
    }
  });
  $("#sidebarOverlay").click(function (e) {
    e.preventDefault();
    $("body").toggleClass("hide-sidebar");
    $("#sidebarOverlay").slideToggle();
    $("html,body").css("overflow-y", "auto");
  });
  $("#sidebarArea .accordion-button").click(function (e) {
    e.preventDefault();
    if ($("body").hasClass("short_sidebar_active")) {
      $("body").removeClass("short_sidebar_active");
      $(openSidebarBtnEl).hide();
    }
  });

  //Video Popup
  $(".modal_video_btn").modalVideo({
    youtube: {
      controls: 1,
      nocookie: true,
    },
  });
  //Counter
  $(".count-num").rCounter({
    duration: 30,
  });
  // <span class="count-num">2575</span> if decimal 2,5.6
  //Select 2
  function selectTwo(selectID, placeholder) {
    $(selectID).select2({
      placeholder: placeholder,
    });
  }
  if (document.querySelector("#citySelect")) {
    selectTwo("#citySelect", "Select City");
  }

  //Month filter
  $("#monthFilterLists button").click(function () {
    $(this).addClass("active_month").siblings().removeClass("active_month");
  });

  //Date Range
  // Check if Moment.js is loaded
  if (typeof moment !== "undefined") {
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
      $("#reportrange span").html(
        start.format("DD MMM YYYY") + " - " + end.format("DD MMM YYYY")
      );
    }

    $("#reportrange").daterangepicker(
      {
        startDate: start,
        endDate: end,
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days"),
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment().subtract(1, "month").startOf("month"),
            moment().subtract(1, "month").endOf("month"),
          ],
        },
      },
      cb
    );

    cb(start, end);
  }
  // To disable the DateRangePicker:
// $('#reportrange').data('daterangepicker').isShowing = false;
// $('#reportrange').off('click.daterangepicker');
// $('#reportrange').css('pointer-events', 'none');

  //Searchable select
  const searchSelect = $(".js-searchBox");
  if (searchSelect) {
    $(".js-searchBox").searchBox();
  }
});

//Add Class
function displayItem(addID, addClass, ovlerlayID) {
  let addDiv = document.querySelector(`#${addID}`);
  let ovlerlayDiv = document.querySelector(`#${ovlerlayID}`);
  addDiv.classList.toggle(addClass);
  ovlerlayDiv.style.cssText = "  display: block;";
}
//Remove Class
function removeDisplayItem(removeID, removeClass, ovlerlayID) {
  let addDiv = document.querySelector(`#${removeID}`);
  let ovlerlayDiv = document.querySelector(`#${ovlerlayID}`);
  addDiv.classList.toggle(removeClass);
  ovlerlayDiv.style.cssText = "  display: none;";
}

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
let navbarCloseIcon = document.querySelector(".close_icon");
let navbarOverlay = document.querySelector(".mobile_menu_overlay");
let mobileMenuArea = document.querySelector(".mobile_menu_area");
if (navbarIcon) {
  navbarIcon.addEventListener("click", () => {
    mobileMenuArea.classList.add("navbar_active");
    scrollOutsideHidden();
  });
}
if (navbarIcon) {
  navbarCloseIcon.addEventListener("click", () => {
    hideNavbar();
  });
}

if (navbarIcon) {
  navbarOverlay.addEventListener("click", () => {
    hideNavbar();
  });
}

function hideNavbar() {
  mobileMenuArea.classList.remove("navbar_active");
  scrollOutsideScroll();
}

// Form Validation Methods Using Bootstrap 5
(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

//Tooltip
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

//Slider Single
function singleSlider(
  sliderID,
  sliderNextArrow,
  sliderPrevArrow,
  sliderSpeed = 5000
) {
  var swiperHero = new Swiper(`${sliderID} .swiper`, {
    speed: 1100,

    autoplay: {
      delay: sliderSpeed,
      pauseOnMouseEnter: true,
    },
    keyboard: {
      enabled: true,
      // onlyInViewport: true,
    },
    navigation: {
      nextEl: sliderNextArrow,
      prevEl: sliderPrevArrow,
    },
  });
}

// Int Number
var inputTelephone = document.querySelector("#telephone");
if (inputTelephone) {
  window.intlTelInput(inputTelephone, {
    separateDialCode: true,
    preferredCountries: ["us", "gb", "ca"],
  });
}
var inputTelephone2 = document.querySelector("#telephone2");
if (inputTelephone2) {
  window.intlTelInput(inputTelephone2, {
    separateDialCode: true,
    preferredCountries: ["us", "gb", "ca"],
  });
}

//Quotation  Increment Decrement
let qtyPlusButton = document.querySelector("#qtyPlusButton");
let qtyMinusButton = document.querySelector("#qtyMinusButton");
let qtyProductValue = document.querySelector("#qtyProductValue");

if (qtyProductValue) {
  qtyProductValue.value = 0;
}

if (qtyPlusButton) {
  qtyPlusButton.addEventListener("click", () => {
    qtyProductValue.value = parseInt(qtyProductValue.value) + 1;
  });
}
if (qtyMinusButton) {
  qtyMinusButton.addEventListener("click", () => {
    if (qtyProductValue.value > 0) {
      qtyProductValue.value = parseInt(qtyProductValue.value) - 1;
    }
  });
}

//Password Visibility
//01.Login
let inputPassword1 = document.querySelector("#password_input1");
if (inputPassword1) {
  inputPassword1.addEventListener("click", () => {
    passwordVisibility(
      "password_input1",
      "password_eye_icon_area1",
      "eyeOpen1",
      "eyeClose1"
    );
  });
}
let inputPassword2 = document.querySelector("#password_input2");
if (inputPassword2) {
  inputPassword2.addEventListener("click", () => {
    passwordVisibility(
      "password_input2",
      "password_eye_icon_area2",
      "eyeOpen2",
      "eyeClose2"
    );
  });
}
let inputPassword3 = document.querySelector("#password_input3");
if (inputPassword3) {
  inputPassword3.addEventListener("click", () => {
    passwordVisibility(
      "password_input3",
      "password_eye_icon_area3",
      "eyeOpen3",
      "eyeClose3"
    );
  });
}

function passwordVisibility(inputId, eyeIconArea, eyeOpen, eyeClose) {
  let passwordInput = document.getElementById(inputId);
  let passwordIconArea = document.getElementById(eyeIconArea);
  let eyeOpenIcon = document.getElementById(eyeOpen);
  let eyeCloseIcon = document.getElementById(eyeClose);
  passwordIconArea.style.cssText = "display:inline";
  eyeOpenIcon.addEventListener("click", () => {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    }
    eyeOpenIcon.style.cssText = "display:none";
    eyeCloseIcon.style.cssText = "display:inline";
  });
  eyeCloseIcon.addEventListener("click", () => {
    if (passwordInput.type === "text") {
      passwordInput.type = "password";
    }
    eyeCloseIcon.style.cssText = "display:none";
    eyeOpenIcon.style.cssText = "display:inline";
  });
}

// ScrollToUp
// let scroll = document.querySelector("#scrollTop");
// function scrollUp() {
//   window.scrollTo({
//     top: 0,
//     behavior: "smooth",
//   });
// }
// if (scroll) {
//   window.addEventListener("scroll", function () {
//     scroll.classList.toggle("scroll_active", window.scrollY > 500);
//   });
//   scroll.addEventListener("click", () => {
//     scrollUp();
//   });
// }
