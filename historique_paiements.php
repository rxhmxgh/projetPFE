<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: seconnecter.php");
    exit();
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les paiements de l'utilisateur
    $stmt = $pdo->prepare("SELECT type_service, destinataire, montant, date_paiement FROM paiements WHERE user_id = ? ORDER BY date_paiement DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $paiements = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Paiements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-retour {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .btn-retour:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Historique de vos paiements</h2>

<?php if (count($paiements) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Destinataire</th>
                <th>Montant (DA)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paiements as $paiement): ?>
                <tr>
                    <td><?= htmlspecialchars($paiement['type_service']) ?></td>
                    <td><?= htmlspecialchars($paiement['destinataire']) ?></td>
                    <td><?= number_format($paiement['montant'], 2, ',', ' ') ?></td>
                    <td><?= htmlspecialchars($paiement['date_paiement']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align:center;">Aucun paiement trouvé.</p>
<?php endif; ?>

<a href="bonjour.php" class="btn-retour">← Retour au compte</a>

</body>
</html>
