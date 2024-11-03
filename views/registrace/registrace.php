<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesRegister.css">
    <title>Registrace</title>
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Vytvořte si účet</h2>
            <form action="register.php" method="POST">
                <div class="input-box">
                    <label for="name">Jméno</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-box">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-box">
                    <label for="password">Heslo</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-box">
                    <label for="confirm_password">Potvrzení hesla</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="input-box">
                    <label for="phone">Telefonní číslo</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="input-box">
                    <label for="dob">Datum narození</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="input-box">
                    <label for="dob">Věk</label>
                    <input type="age" id="age" name="age" required>
                </div>
                
                <div class="register-background"></div>
<div class="register-container"></div>

  
  
</div>
                <button type="submit">Zaregistrovat se</button>
            </form>
        </div>
    </div>
</body>
</html>
