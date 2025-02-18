function togglePasswordVisibility(repeat = false) {
  const passwordField = document.getElementById("password" + (repeat ? "-repeat" : ""));
  const eyeIcon = document.getElementById("eye-icon" + (repeat ? "-repeat" : ""));

  if (passwordField.type === "password") {
      passwordField.type = "text";
      eyeIcon.setAttribute("fill", "#333");
  } else {
      passwordField.type = "password";
      eyeIcon.setAttribute("fill", "none");
  }
}