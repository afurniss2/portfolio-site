window.addEventListener('error', function (e) {
  console.error("Script error:", e.message, "at", e.filename, "line", e.lineno);
});

document.getElementById('contactForm').addEventListener('submit', (e) => {
  e.preventDefault();
  console.log("Do we get here");
  const formData = new FormData(e.target);
  const feedback = document.getElementById('formFeedback');
  console.log(formData);

  fetch('submit_contact.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(result => {
    if (result === "success") {
      feedback.textContent = "Message sent!";
      feedback.style.color = "green";
      e.target.reset();
    } else {
      feedback.textContent = "Something went wrong.";
      feedback.style.color = "red";
    }
  });
});

const carousels = {
  1: ["img/project1-1.png", "img/project1-2.png"],
  2: ["img/project2-1.png", "img/project2-2.png", "img/project2-3.png"]
};

const carouselIndexes = { 1: 0, 2: 0 };

function showImage(projectId) {
  const imgElement = document.getElementById(`carouselImg-${projectId}`);
  if (!imgElement) return;

  imgElement.classList.add('fade-out');

  setTimeout(() => {
    const currentIndex = carouselIndexes[projectId];
    imgElement.src = carousels[projectId][currentIndex];

    imgElement.classList.remove('fade-out');
  }, 400);
}



function nextImg(projectId) {
  carouselIndexes[projectId] = (carouselIndexes[projectId] + 1) % carousels[projectId].length;
  showImage(projectId);
}

function prevImg(projectId) {
  carouselIndexes[projectId] = (carouselIndexes[projectId] - 1 + carousels[projectId].length) % carousels[projectId].length;
  showImage(projectId);
}

document.addEventListener("DOMContentLoaded", () => {
  Object.keys(carousels).forEach(id => showImage(id));
});

const scrollBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", () => {
  if (window.scrollY > 300) {
    scrollBtn.style.display = "block";
  } else {
    scrollBtn.style.display = "none";
  }
});

scrollBtn.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

const themeSelector = document.getElementById("themeSelector");
const themeClasses = ["theme-dark", "theme-peach", "theme-forest"];

themeSelector.addEventListener("change", () => {
  const selectedTheme = themeSelector.value;

  document.body.classList.remove(...themeClasses);

  if (selectedTheme !== "default") {
    document.body.classList.add(`theme-${selectedTheme}`);
  }
});
