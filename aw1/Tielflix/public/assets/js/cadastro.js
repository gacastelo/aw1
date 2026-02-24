const usernameInput = document.getElementById("username");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const validateBtn = document.getElementById("validate-btn");
usernameInput.addEventListener("input", validateForm);
if (emailInput) {
  emailInput.addEventListener("input", validateForm);
}
passwordInput.addEventListener("input", validateForm);

function validateForm() {
  if (
    usernameInput.value.length > 0 &&
    emailInput.value.length > 0 &&
    passwordInput.value.length >= 8
  ) {
    validateBtn.removeAttribute("disabled");
  } else {
    validateBtn.setAttribute("disabled", "true");
  }
}
validateForm();

const eye = document.getElementById("eye");
eye.addEventListener("click", () => {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
  eye.textContent = type === "password" ? "👁️‍🗨️" : "👁️";
});