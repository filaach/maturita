function togglePasswordVisibility() {
  const passwordField = document.getElementById("password");
  const eyeIcon = document.getElementById("eye-icon");

  if (passwordField.type === "password") {
      passwordField.type = "text";
      eyeIcon.setAttribute("fill", "#333");
  } else {
      passwordField.type = "password";
      eyeIcon.setAttribute("fill", "none");
  }
}