<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'banquemoderne';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les rendez-vous
$stmt = $pdo->query("SELECT * FROM rendezvous ORDER BY date, heure");
$rendezvous = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4 text-primary">📋 Liste des rendez-vous planifiés</h2>

    <?php if (count($rendezvous) > 0): ?>
      <table class="table table-bordered table-hover bg-white shadow">
        <thead class="table-success">
          <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Type</th>
            <th>Date</th>
            <th>Heure</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rendezvous as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r['nom']) ?></td>
              <td><?= htmlspecialchars($r['email']) ?></td>
              <td><?= htmlspecialchars($r['telephone']) ?></td>
              <td><?= htmlspecialchars($r['type']) ?></td>
              <td><?= htmlspecialchars($r['date']) ?></td>
              <td><?= htmlspecialchars($r['heure']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-center">Aucun rendez-vous enregistré pour le moment.</p>
    <?php endif; ?>
  </div>
</body>
</html>
