<?php
$conn = new mysqli("localhost", "root", "", "banquemoderne");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message envoyé avec succès.'); window.location.href='acceuil.php';</script>";
    } else {
        echo "Erreur lors de l'envoi : " . $conn->error;
    }
}

$conn->close();
?>
