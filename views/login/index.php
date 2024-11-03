<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../styles.css">
    <title>Document</title>
    <script>function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.setAttribute("fill", "#333"); // Změní barvu ikony při zobrazení hesla
            } else {
                passwordField.type = "password";
                eyeIcon.setAttribute("fill", "none"); // Změní barvu ikony při skrytí hesla
            }
        }
    </script>
</head>

<body>

    <div class="login-container">
        <h2>Přihlášení</h2>
        <form action="login.php" method="POST">
            <label for="username">Uživatelské jméno:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Heslo:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span id="toggle-password" onclick="togglePasswordVisibility();">
                    <!-- SVG ikona oka -->
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
            </div>



            <button type="submit">Přihlásit se</button>

        </form>
        <p>Nemáte účet? <a href="register.html">Registrujte se</a></p>
    </div>
</body>