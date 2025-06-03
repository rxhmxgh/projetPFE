<?php
$pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("UPDATE rendezvous SET statut = 'confirme' WHERE id = ?");
    $stmt->execute([$id]);
    $r = $stmt->fetch();

    
    echo "<script>alert('Rendez-vous confirmé.'); window.location.href='admin_rendezvous.php';</script>";
}

$utilisateur_id = $r['utilisateur_id']; // ID du client
$message = "Votre rendez-vous du {$r['date_rdv']} à {$r['heure_rdv']} a été confirmé.";

$stmt = $pdo->prepare("INSERT INTO notifications (utilisateur_id, message) VALUES (?, ?)");
$stmt->execute([$utilisateur_id, $message]);


?>
