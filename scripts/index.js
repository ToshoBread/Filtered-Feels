const newPostBtn = document.querySelector("#new-post");
const navNewPostBtn = document.querySelector("#nav-new-post");
const navbar = document.querySelector(".navbar");

window.onload = () => {
  navNewPostBtn.classList.add("hide-btn");
};

window.onscroll = () => {
  const bounds = newPostBtn.getBoundingClientRect();

  if (bounds.top < -newPostBtn.offsetHeight) {
    newPostBtn.classList.remove("show-btn");
    newPostBtn.classList.add("hide-btn");
    navNewPostBtn.classList.remove("hide-btn");
    navNewPostBtn.classList.add("show-btn");
  } else {
    newPostBtn.classList.remove("hide-btn");
    newPostBtn.classList.add("show-btn");
    navNewPostBtn.classList.remove("show-btn");
    navNewPostBtn.classList.add("hide-btn");
  }
};
