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

  //Month filter
  $("#monthFilterLists button").click(function () {
    $(this).addClass("active_month").siblings().removeClass("active_month");
  });

  
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

//Tooltip
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

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
