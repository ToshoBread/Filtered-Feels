function openCard(postId, userId = null) {
  const params = new URLSearchParams({
    user: userId,
    post: postId,
  });

  window.location.href = `post.php?${params.toString()}`;
}

const allPosts = document.querySelectorAll(".post");

if (allPosts !== null) {
  allPosts.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      card.classList.remove("shadow");
      card.classList.add("shadow-lg");
    });

    card.addEventListener("mouseleave", () => {
      card.classList.remove("shadow-lg");
      card.classList.add("shadow");
    });

    card.addEventListener("click", () => {
      const userId = card.dataset.userId;
      const postId = card.dataset.postId;
      openCard(postId, userId);
    });
  });
}

const editPostBtn = document.querySelector("#edit-post-btn");
const cancelEditBtn = document.querySelector("#cancel-edit-btn");
const postDetails = document.querySelectorAll(".post-detail");
const postInputs = document.querySelectorAll(".post-input");

const headerImg = document.querySelector("#header-img");
const headerImgWrapper = document.querySelector("#header-img-wrapper");
const editHeaderImg = document.querySelector("#edit-header-img");
const changeImgBtn = document.querySelector("#change-img-btn");
const removeImgBtn = document.querySelector("#remove-img-btn");

const editContentArea = document.querySelector("#edit-content-area");

if (postInputs !== null) {
  postInputs.forEach((detail) => {
    detail.classList.add("d-none");
  });
}

if (editPostBtn !== null) {
  editPostBtn.onclick = () => {
    postDetails.forEach((detail) => {
      detail.classList.add("d-none");
    });

    postInputs.forEach((detail) => {
      detail.classList.remove("d-none");
    });
  };

  cancelEditBtn.onclick = () => {
    postDetails.forEach((detail) => {
      detail.classList.remove("d-none");
    });

    postInputs.forEach((detail) => {
      detail.classList.add("d-none");
    });
  };

  editContentArea.oninput = () => {
    editContentArea.style.height = "auto";
    editContentArea.style.height = editContentArea.scrollHeight + "px";
  };

  removeImgBtn.onclick = () => {
    headerImg.src = "";
  };
}
