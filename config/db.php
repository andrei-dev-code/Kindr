<?php

$conn = new mysqli("localhost", "root", "", "kindr");

if ($conn->connect_error) {
    die("DB error: " . $conn->connect_error);
}

?>
