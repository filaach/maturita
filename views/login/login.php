<?php
session_start();

// Připojení k databázi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_social_network"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Zkontroluj připojení
if ($conn->connect_error) {
    die("Připojení selhalo: " . $conn->connect_error);
}

// Získání přihlašovacích údajů z formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ověření uživatelského jména a hesla
    $sql = "SELECT id, password_hash FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password_hash);
        $stmt->fetch();

        if (password_verify($password, $password_hash)) {
            // Úspěšné přihlášení
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
        } else {
            echo "Špatné heslo.";
        }
    } else {
        echo "Uživatel nenalezen.";
    }
    $stmt->close();
}
$conn->close();
?>
