<?php

$pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Supprimer d'abord les transactions liées à cet utilisateur
    $stmt1 = $pdo->prepare("DELETE FROM transactions WHERE utilisateur_id = ?");
    $stmt1->execute([$id]);

    // Puis supprimer l'utilisateur
    $stmt2 = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt2->execute([$id]);

    echo "<script>alert('Client et ses transactions supprimés avec succès.'); window.location.href='administration.php';</script>";
} else {
    echo "ID invalide.";
}
