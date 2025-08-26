const imgInput = document.getElementById("header-img");
const imgPreview = document.getElementById("img-preview");
const noteContent = document.getElementById("note-content");

imgInput.onchange = () => {
  const [file] = imgInput.files;
  if (file) {
    imgPreview.src = URL.createObjectURL(file);
    noteContent.classList.remove("rounded-1");
    noteContent.classList.add("rounded-top-0");
    noteContent.classList.add("rounded-bottom-1");
  }
};
