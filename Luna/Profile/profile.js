// script.js

// Function to handle the click event of the navigation links
function handleNavClick(event) {
  event.preventDefault();
  var targetSection = event.target.dataset.section;
  var profileSections = document.querySelectorAll(".profile-section");

  profileSections.forEach(function (section) {
    if (section.id === targetSection) {
      section.classList.add("show");
      hideCancelConfirmation();
      hideUpgradePopup();
    } else {
      section.classList.remove("show");
    }
  });
}

// Event listener to handle the click event on the navigation links
var navLinks = document.querySelectorAll(".nav-link");
navLinks.forEach(function (link) {
  link.addEventListener("click", handleNavClick);
});

//COlor
// Get the side navigation links
const sideNavLinks = document.querySelectorAll(".side-nav a");
// Get the profile sections
const profileSections = document.querySelectorAll(".profile-section");

// Add event listener to each side navigation link
sideNavLinks.forEach((link, index) => {
  link.addEventListener("click", () => {
    // Hide all profile sections
    profileSections.forEach((section) => {
      section.classList.remove("show");
    });

    // Show the selected profile section
    profileSections[index].classList.add("show");

    // Remove the active class from all side navigation links
    sideNavLinks.forEach((link) => {
      link.classList.remove("active");
    });

    // Add the active class to the clicked side navigation link
    link.classList.add("active");
  });
});

//Validation

function isValidEmail(email) {
  // basic email validation
  const emailRegex = /^\S+@\S+\.\S+$/;
  return emailRegex.test(email);
}
function isValidPassword(password) {
  // Regular expression to match password pattern
  const passwordPattern = /^(?=.*\d)(?=.*[A-Z]).{6,}$/;
  return passwordPattern.test(password);
}
function isValidCountry(country) {
  // Array of valid countries
  const validCountries = [
    "United States",
    "Canada",
    "United Kingdom",
    "Ethiopia",
    "Saudi Arabia",
    "Singapore",
    "China",
    "India",
    "Japan",
    "South Korea",
    "Brazil",
    "Russia",
    "Germany",
    "France",
    "Italy",
    "Spain",
    "Netherlands",
    "Sweden",
    "Switzerland",
    // countries mechemer yichalal
  ];

  return validCountries.includes(country);
}

// Validate Edit Profile form
let profileForm = document.getElementById("profile-form");
let username = profileForm.elements["username"];
let email = profileForm.elements["email"];
let region = profileForm.elements["country"];
let dob = profileForm.elements["dob"];
let img = document.querySelector("#profile-form img");
let container1 = document.querySelectorAll(".profile-section > :last-child ");
container1[0].style.minHeight = "400px";
img.style.display = "none";

profileForm.addEventListener("submit", (e) => {
  if (validateProForm()) {
    img.style.display = "none";
    container1[0].style.height = "66vh";
    container1[0].previousElementSibling.style.height = "66vh";
    container1[0].parentElement.style.padding = "5%";
  } else {
    e.preventDefault();
    img.style.display = "inline-block";
  }
});

function setError(element, message) {
  let error = element.nextElementSibling;
  error.textContent = message;
  error.style.display = "block";
  img.style.display = "inline-block";

  const inputControl = element.parentElement;
  inputControl.classList.add("error");
  container1[0].style.height = "80vh";
  container1[0].previousElementSibling.style.height = "80vh";
  container1[0].parentElement.style.padding = "0%";
}

function setSuccess(element) {
  let errorElement = element.nextElementSibling;
  errorElement.textContent = "";
  const inputControl = element.parentElement;
  inputControl.classList.remove("error");
}

function validateProForm() {
  let isValid = true;

  // Username
  if (username.value == "") {
    setError(username, "Username is required");
    isValid = false;
  } else {
    setSuccess(username);
  }

  // Email
  if (email.value == "") {
    setError(email, "Email is required");
    isValid = false;
  } else if (!isValidEmail(email.value)) {
    setError(email, "Invalid email format");
    isValid = false;
  } else {
    setSuccess(email);
  }

  // Country/Region
  if (country.value == "") {
    setError(region, "Country is required");
    isValid = false;
  } else if (!isValidCountry(region.value)) {
    setError(region, "Invalid country");
    isValid = false;
  } else {
    setSuccess(region);
  }

  // Date of Birth
  if (dob.value == "") {
    setError(dob, "Date of Birth is required");
    isValid = false;
  } else {
    setSuccess(dob);
  }

  return isValid;
}

// Validate Privacy Form
let privacyForm = document.getElementById("privacy-form");
let currentPassword = privacyForm.elements["current-password"];
let newPassword = privacyForm.elements["new-password"];
let confirmNewPassword = privacyForm.elements["confirm-new-password"];

img.style.display = "none";

privacyForm.addEventListener("submit", (e) => {
  if (!validatePrivacyForm()) e.preventDefault();
});

function validatePrivacyForm() {
  let isValid = true;
  let curr = document.querySelector("#privacy-form #curr");

  if (currentPassword.value === "" && newPassword.value === "") return isValid;
  // Current Password
  if (currentPassword.value === "") {
    setError(currentPassword, "Current Password is required");
    isValid = false;
  } else if (curr.textContent !== currentPassword.value) {
    setError(currentPassword, "Incorrect current password. Please try again.");
    isValid = false;
  } else {
    setSuccess(currentPassword);
  }

  // New Password
  if (newPassword.value === "") {
    setError(newPassword, "New Password is required");
    isValid = false;
  } else if (newPassword.value.length < 8) {
    setError(newPassword, "Password must be at least 8 characters");
    isValid = false;
  } else if (!isValidPassword(newPassword.value)) {
    setError(
      newPassword,
      "Password must contain at least 1 uppercase letter and 1 number"
    );
    isValid = false;
  } else {
    setSuccess(newPassword);
  }

  // Confirm New Password
  if (confirmNewPassword.value === "") {
    setError(confirmNewPassword, "Confirm New Password is required");
    isValid = false;
  } else if (confirmNewPassword.value !== newPassword.value) {
    setError(confirmNewPassword, "Passwords do not match");
    isValid = false;
  } else {
    setSuccess(confirmNewPassword);
  }

  return isValid;
}

//PLANS script is in php

//  hide the changed message after 5 seconds
setTimeout(function () {
  var changedMessage = document.getElementById("changed-message");
  var successMessage = document.getElementById("success-message");
  var errorMessage = document.getElementById("error-message");
  if (changedMessage) {
    changedMessage.style.display = "none";
  }
  if (successMessage) {
    successMessage.style.display = "none";
  }
  if (errorMessage) {
    errorMessage.style.display = "none";
  }
}, 6000);

//Upgrade S
function showUpgradePopup() {
  document.getElementById("subscription-details").classList.add("blur-overlay");
  upgradePopup = document.getElementById("upgrade-popup");
  upgradePopup.style.display = "flex";
  upgradePopup.style.flexDirection = "column";
  upgradePopup.style.alignItems = "center";
  upgradePopup.style.justifyContent = "center";
  button = upgradePopup.getElementById("upgradeButton");
  button.addEventListener("click", () =>{
    hideUpgradePopup();
  })
}

function hideUpgradePopup() {
  document.getElementById("upgrade-popup").style.display = "none";
  document
    .getElementById("subscription-details")
    .classList.remove("blur-overlay");
}

//CAncel Subscription
function showCancelConfirmation() {
  document.getElementById("subscription-details").classList.add("blur-overlay");
  cancelC = document.getElementById("cancel-confirmation");
  cancelC.style.display = "flex";
  cancelC.style.flexDirection = "column";
  cancelC.style.alignItems = "center";
  cancelC.style.justifyContent = "center";
  button = cancelC.firstElementChild.nextElementSibling;
  button.addEventListener("click", () => {
    hideCancelConfirmation();
  });
}

function hideCancelConfirmation() {
  document.getElementById("cancel-confirmation").style.display = "none";
  document
    .getElementById("subscription-details")
    .classList.remove("blur-overlay");
}
