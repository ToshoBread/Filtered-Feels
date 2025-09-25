const currentPage = window.location.pathname.split("/").pop();
const navLink = document.querySelectorAll(".nav-link");
navLink.forEach((link) => {
  if (link.getAttribute("href") === currentPage) {
    link.classList.add("active");
    link.setAttribute("aria-current", "page");
  } else {
    link.classList.remove("active");
  }
});
