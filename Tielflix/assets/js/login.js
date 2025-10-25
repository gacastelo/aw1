const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const eye = document.getElementById("eye");
eye.addEventListener("click", () => {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
  eye.textContent = type === "password" ? "👁️‍🗨️" : "👁️";
});