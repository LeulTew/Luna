const darkModeBtn = document.getElementById("dark-mode-btn");
const modeIcon = document.getElementById("mode-icon");
const overlay = document.querySelector(".overlay2");

darkModeBtn.addEventListener("click", toggleDarkMode);

function toggleDarkMode() {
  if (modeIcon.src.includes("pics/dark.png")) {
    // Switch to dark mode
    modeIcon.src = "pics/light.png";
    overlay.style.background = "rgba(15, 13, 23, 1)";
    darkModeBtn.style.boxShadow = "0 0 10px rgba(15, 13, 23, 0.7)";
    modeIcon.style.filter ="invert(0)"

  } else {
    // Switch to light mode
    modeIcon.src = "pics/dark.png";
    overlay.style.background =
      "linear-gradient(to top, rgba(0, 0, 0, 2) 0%, rgb(17, 15, 26, 0.1) 100%)";
    darkModeBtn.style.boxShadow = "none";
    modeIcon.style.filter ="invert(1)"
  }
}
