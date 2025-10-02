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
      const randomRotateDeg = Math.floor(Math.random() * 5) - 2;
      const reroll = randomRotateDeg === 0 ? randomRotateDeg : randomRotateDeg;
      card.style.transform = `rotate(${reroll}deg)`;
    });

    card.addEventListener("mouseleave", () => {
      card.classList.remove("shadow-lg");
      card.classList.add("shadow");
      card.style.transform = `rotate(0deg)`;
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
const editHeaderImg = document.querySelector("#edit-header-img");
const changeImgBtn = document.querySelector("#change-img-btn");
const removeImgBtn = document.querySelector("#remove-img-btn");
const deletedImgFlag = document.querySelector("#deleted-img-flag");

const postTitle = document.querySelector("#title");
const postSignature = document.querySelector("#signature");
const postContent = document.querySelector("#content");

const editContentArea = document.querySelector("#edit-content-area");
const editTitle = document.querySelector("#edit-title");
const editSignature = document.querySelector("#edit-signature");

if (postInputs !== null) {
  postInputs.forEach((detail) => {
    detail.classList.add("d-none");
  });
}

if (editPostBtn !== null) {
  const savedHeaderImg = headerImg.src;

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

    postInputs.forEach((inputs) => {
      inputs.classList.add("d-none");
    });

    if (savedHeaderImg !== headerImg.src) {
      headerImg.src = savedHeaderImg;
    }

    if (headerImg.src === window.location.href) {
      headerImg.src = "#";
    }

    deletedImgFlag.value = "0";
    editTitle.value = postTitle.innerText;
    editSignature.value = postSignature.innerText;
    editContentArea.value = postContent.innerText;
  };

  editHeaderImg.onchange = () => {
    const [file] = editHeaderImg.files;
    if (file) {
      headerImg.src = URL.createObjectURL(file);
      deletedImgFlag.value = "0";
    }
  };

  editContentArea.oninput = () => {
    editContentArea.style.height = "auto";
    editContentArea.style.height = editContentArea.scrollHeight + "px";
  };

  removeImgBtn.onclick = () => {
    editHeaderImg.value = "";
    headerImg.src = "";
    deletedImgFlag.value = "1";
  };
}
