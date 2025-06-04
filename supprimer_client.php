<?php
$pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // 1. Supprimer les notifications liées
    $stmt0 = $pdo->prepare("DELETE FROM notifications WHERE user_id = ?");
    $stmt0->execute([$id]);

    // 2. Supprimer les transactions liées
    $stmt1 = $pdo->prepare("DELETE FROM transactions WHERE utilisateur_id = ?");
    $stmt1->execute([$id]);

    // 3. Supprimer l'utilisateur
    $stmt2 = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt2->execute([$id]);

    echo "<script>alert('Client, transactions et notifications supprimés avec succès.'); window.location.href='administration.php';</script>";
} else {
    echo "ID invalide.";
}
?>
