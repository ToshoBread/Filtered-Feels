const newPostBtn = document.querySelector("#new-post");
const navNewPostBtn = document.querySelector("#nav-new-post");
const navbar = document.querySelector(".navbar");
const navbarHeight = navbar.offsetHeight - newPostBtn.offsetHeight;

window.onscroll = () => {
  const bounds = newPostBtn.getBoundingClientRect();

  if (bounds.top < navbarHeight) {
    newPostBtn.classList.remove("show");
    newPostBtn.classList.add("hide");
    navNewPostBtn.classList.remove("hide");
    navNewPostBtn.classList.add("show");
  } else {
    newPostBtn.classList.remove("hide");
    newPostBtn.classList.add("show");
    navNewPostBtn.classList.remove("show");
    navNewPostBtn.classList.add("hide");
  }
};
