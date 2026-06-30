<?php
require_once "config/db.php";

$team_email = "team@kindr.ro";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);

    // 1. validare email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email invalid");
    }

    // 2. verificăm dacă există deja
    $check = $conn->prepare("SELECT id FROM subscribers WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        die("Esti deja abonat ❤️");
    }

    // 3. inserare in DB
    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {

        // 4. notificare echipa
        mail(
            $team_email,
            "Nou abonat Kindr",
            "Un nou user s-a abonat: " . $email,
            "From: no-reply@kindr.ro"
        );

        echo "
        <div style='
            background:#0b0b12;
            color:white;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            font-family:Arial;
            text-align:center;
        '>
            <div>
                <h1>Mulțumim ❤️</h1>
                <p>Te-ai abonat cu succes la Kindr.</p>
                <a href='index.html' style='color:#7c4dff;'>Înapoi</a>
            </div>
        </div>
        ";

    } else {
        echo "Eroare la salvare.";
    }
}
?>
