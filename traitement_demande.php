<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: connex.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $type = $_POST["type"];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO demande_carte (nom, email, type) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $type]);

        echo "<script>alert('✅ Votre demande a été envoyée avec succès !'); window.location.href='carte.php';</script>";
    } catch (PDOException $e) {
        echo "❌ Erreur : " . $e->getMessage();
    }
}
?>
