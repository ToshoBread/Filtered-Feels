const postInputs = document.querySelectorAll(".post-input");
const editPostBtn = document.querySelector("#edit-post-btn");
const cancelEditBtn = document.querySelector("#cancel-edit-btn");
const postDetails = document.querySelectorAll(".post-detail");

const headerImg = document.querySelector("#header-img");
const editHeaderImg = document.querySelector("#edit-header-img");
const removeImgBtn = document.querySelector("#remove-img-btn");
const deletedImgFlag = document.querySelector("#deleted-img-flag");

const postTitle = document.querySelector("#title");
const postSignature = document.querySelector("#signature");
const postContent = document.querySelector("#content");

const editContentArea = document.querySelector("#edit-content-area");
const editTitle = document.querySelector("#edit-title");
const editSignature = document.querySelector("#edit-signature");

const colorRadios = document.querySelectorAll('input[name="color"]');
const postContainer = document.querySelector("#post-container");
const currColor = document.querySelector('input[name="color"]:checked');
let newColor = "";

if (postInputs !== null) {
  postInputs.forEach((detail) => {
    detail.classList.add("d-none");
  });
}

if (editPostBtn !== null) {
  const currHeaderImg = headerImg.src;

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

    if (currHeaderImg !== headerImg.src) {
      headerImg.src = currHeaderImg;
    }

    if (headerImg.src === window.location.href) {
      headerImg.src = "#";
    }

    if (currColor.value !== newColor) {
      postContainer.style.border = `solid 0.2rem #${currColor.value}`;
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

  colorRadios.forEach((color) => {
    color.onchange = () => {
      if (color.checked) {
        postContainer.style.border = `solid 0.15rem #${color.value}`;
        postContainer.style.backgroundColor = `#${color.value}10`;
      }
    };
  });
}
