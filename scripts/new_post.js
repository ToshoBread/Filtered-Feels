const imgInput = document.querySelector("#input-header-img");
const imgPreview = document.querySelector("#img-preview");
const noteContent = document.querySelector("#note-content");

const removeImgBtn = document.querySelector("#remove-img-btn");
removeImgBtn.style.display = "none";

imgInput.onchange = () => {
  const [file] = imgInput.files;
  if (file) {
    imgPreview.src = URL.createObjectURL(file);
    noteContent.classList.remove("rounded-1");
    noteContent.classList.add("rounded-top-0");
    noteContent.classList.add("rounded-bottom-1");
    removeImgBtn.style.display = "block";
  }
};

removeImgBtn.onclick = () => {
  imgInput.value = "";
  imgPreview.src = "";
  noteContent.classList.add("rounded-1");
  noteContent.classList.remove("rounded-top-0");
  noteContent.classList.remove("rounded-bottom-1");
  removeImgBtn.style.display = "none";
};
