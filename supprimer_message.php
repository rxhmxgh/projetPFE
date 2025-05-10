<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "banquemoderne";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $conn->query("DELETE FROM messages WHERE id = $id");
}

$conn->close();
header("Location: admin_message.php");
exit;


?>
