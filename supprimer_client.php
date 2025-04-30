
<?php
$pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);

    echo "<script>alert('Client supprimé avec succès.'); window.location.href='administration.php';</script>";
} else {
    echo "ID invalide.";
}
