<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" href="stylesRegister.css">
</head>
<body>
    <div class="background">
        <div class="login-container">
            <h2>Registrace</h2>
            <form action="register.php" method="POST">
                <label for="name">Jméno:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Heslo:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm-password">Potvrzení hesla:</label>
                <input type="password" id="confirm-password" name="confirm_password" required>

                <button type="submit">Zaregistrovat se</button>
            </form>
        </div>
    </div>
</body>
</html>
