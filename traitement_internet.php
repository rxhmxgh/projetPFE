<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: seconnecter.php");
    exit();
}

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type_service'];
    $identifiant = $_POST['identifiant'];
    $montant = floatval($_POST['montant']);

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT solde FROM utilisateurs WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if ($user && $user['solde'] >= $montant) {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET solde = solde - ? WHERE id = ?");
            $stmt->execute([$montant, $_SESSION['user_id']]);

            $stmt = $pdo->prepare("INSERT INTO paiements (user_id, type_service, destinataire, montant) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], ucfirst($type), $identifiant, $montant]);

            $success = "Paiement réussi pour $identifiant - $montant DA.";
        } else {
            $error = "Solde insuffisant.";
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat Paiement Algérie Télécom</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 50px; text-align: center; }
        .message { padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px #ccc; display: inline-block; }
        .success { color: green; }
        .error { color: red; }
        a { margin-top: 20px; display: inline-block; color: #004080; text-decoration: none; }
    </style>
</head>
<body>
    <div class="message">
        <?php if ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php else: ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <a href="paiment.php">← Retour aux paiements</a>
    </div>
</body>
</html>
