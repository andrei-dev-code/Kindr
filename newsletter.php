<?php
// =========================
// KINDR NEWSLETTER SYSTEM
// =========================

// Email-ul echipei Kindr
$team_email = "team@kindr.ro";

// Fișier unde salvăm emailurile
$file = "subscribers.txt";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);

    // validare simplă email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email invalid.");
    }

    // salvare în fișier
    file_put_contents($file, $email . PHP_EOL, FILE_APPEND);

    // email notificare către echipă
    $subject = "Nou abonat Kindr";
    $message = "Ai un nou abonat la newsletter: " . $email;

    $headers = "From: no-reply@kindr.ro" . "\r\n" .
               "Reply-To: no-reply@kindr.ro" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    mail($team_email, $subject, $message, $headers);

    // răspuns simplu
    echo "
    <html>
    <head>
      <title>Kindr Newsletter</title>
      <style>
        body {
          background:#0b0b12;
          color:white;
          display:flex;
          justify-content:center;
          align-items:center;
          height:100vh;
          font-family:Arial;
          text-align:center;
        }
        .box {
          padding:40px;
          border:1px solid rgba(255,255,255,0.1);
          border-radius:12px;
          background:rgba(255,255,255,0.05);
        }
      </style>
    </head>
    <body>
      <div class='box'>
        <h2>Mulțumim!</h2>
        <p>Te-ai abonat cu succes la Kindr.</p>
        <p>Vei primi update-uri pe email.</p>
      </div>
    </body>
    </html>
    ";
}
?>
