<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION["user_id"] = $id;
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo "Date incorecte.";
    }
}
?>

<form method="POST">
    <h2>Login Kindr</h2>

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Parola" required>

    <button type="submit">Intră în cont</button>
</form>
