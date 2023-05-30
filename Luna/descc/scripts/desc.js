function changeId(id) {
  // Set the id parameter to the one clicked
  window.location.href = "?id=" + id;
  location.reload();
}

// PLAY
function openTrailer(trailer) {
  const width = 800; 
  const height = 600; 

  const left = (window.innerWidth - width) / 2;
  const top = (window.innerHeight - height) / 2;

  const options = `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`;
  window.open(
    trailer,
    "_blank",
    options
  ); /*   // Check if the hero section exists
  const heroSection = document.querySelector(".hero");
  const trailplay = document.querySelector(".hero .trailplay");
  heroSection.lastElementChild.style.display = "none";
  heroSection.style.Top = "110%";
  heroSection.style.bottom = "-35%";
  trailplay.style.display = "none";
  document.body.style.overflow = "scroll";

  // Create an iframe element
  const iframe = document.createElement("iframe");
  iframe.setAttribute("src", "");
  iframe.setAttribute("allowfullscreen", trailer);
  iframe.setAttribute("frameborder", "0");
  iframe.classList.add("player-iframe");

  // Create a div element to hold the iframe
  const iframeContainer = document.createElement("div");
  iframeContainer.classList.add("iframe-container");
  iframeContainer.appendChild(iframe);

  // Create a div element for the stop button
  const stopButtonContainer = document.createElement("div");
  stopButtonContainer.classList.add("stop-button-container");

  // Create an image element for the stop button
  const stopImage = document.createElement("img");
  stopImage.setAttribute("src", "pics/stop.png");
  stopImage.setAttribute("alt", "Stop");
  stopImage.classList.add("stop-image");

  // Append the stop button image to the container
  stopButtonContainer.appendChild(stopImage);

  // Append the iframe and stop button container to the body
  document.body.appendChild(iframeContainer);
  iframeContainer.appendChild(stopButtonContainer);
  stopButtonContainer.style.display = "block";

  // Function to close the player and show the hero section
  function closePlayer() {
    // Remove the iframe and stop button container
    iframeContainer.remove();
    stopButtonContainer.remove();
    // Show the hero section
    heroSection.lastElementChild.style.display = "block";
    heroSection.style.Top = "0%";
    heroSection.style.bottom = "10%";
    trailplay.style.display = "inline-block";
    document.body.style.overflow = "hidden"; 
  }

  // Add event listener to the stop button
  stopButtonContainer.addEventListener("click", closePlayer);
  */
}

// Function to open the player page in an iframe
function openPlayer() {
  // Check if the hero section exists
  const heroSection = document.querySelector(".hero");
  const vidplay = document.querySelector(".hero .vidplay");
  heroSection.lastElementChild.style.display = "none";
  heroSection.style.Top = "110%";
  heroSection.style.bottom = "-35%";
  vidplay.style.display = "none";
  document.body.style.overflow = "scroll";

  // Create an iframe element
  const iframe = document.createElement("iframe");
  iframe.setAttribute("src", "Video/player.php");
  iframe.setAttribute("allowfullscreen", "");
  iframe.setAttribute("frameborder", "0");
  iframe.classList.add("player-iframe");

  // Create a div element to hold the iframe
  const iframeContainer = document.createElement("div");
  iframeContainer.classList.add("iframe-container");
  iframeContainer.appendChild(iframe);

  // Create a div element for the stop button
  const stopButtonContainer = document.createElement("div");
  stopButtonContainer.classList.add("stop-button-container");

  // Create an image element for the stop button
  const stopImage = document.createElement("img");
  stopImage.setAttribute("src", "pics/stop.png");
  stopImage.setAttribute("alt", "Stop");
  stopImage.classList.add("stop-image");

  // Append the stop button image to the container
  stopButtonContainer.appendChild(stopImage);

  // Append the iframe and stop button container to the body
  document.body.appendChild(iframeContainer);
  iframeContainer.appendChild(stopButtonContainer);
  stopButtonContainer.style.display = "block";

  // Function to close the player and show the hero section
  function closePlayer() {
    // Remove the iframe and stop button container
    iframeContainer.remove();
    stopButtonContainer.remove();
    // Show the hero section
    heroSection.lastElementChild.style.display = "block";
    heroSection.style.Top = "0%";
    heroSection.style.bottom = "10%";
    vidplay.style.display = "inline-block";
    document.body.style.overflow = "hidden";
  }

  // Add event listener to the stop button
  stopButtonContainer.addEventListener("click", closePlayer);
}
