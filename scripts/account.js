const loginForm = document.querySelector("#login-form");
const registerForm = document.querySelector("#register-form");
const swapToReg = document.querySelector("#swap-to-reg");
const swapToLogin = document.querySelector("#swap-to-login");

swapToReg.addEventListener("click", () => {
  loginForm.classList.add("d-none");
  registerForm.classList.remove("d-none");
});

swapToLogin.addEventListener("click", () => {
  registerForm.classList.add("d-none");
  loginForm.classList.remove("d-none");
});
