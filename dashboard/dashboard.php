<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit;
}
?>

<h1>Welcome to Kindr ❤️</h1>

<p>Ai intrat în platformă.</p>

<a href="auth/logout.php">Logout</a>
