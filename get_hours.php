<?php
$host = 'localhost';
$dbname = 'banquemoderne';
$user = 'root';
$pass = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
  die(json_encode([]));
}

// Récupération des paramètres
$date = $_GET['date'] ?? '';
$type = $_GET['type'] ?? '';

if (!$date || !$type) {
  echo json_encode([]);
  exit;
}

// Bloquer les week-ends
$dayOfWeek = date('w', strtotime($date)); // 0=dimanche, 6=samedi
if ($dayOfWeek == 0 || $dayOfWeek == 6) {
  echo json_encode([]);
  exit;
}

// Définir les horaires en fonction du type
$horaires = [];

switch ($type) {
  case 'Ouverture de compte':
    $start = 8; $end = 11;
    break;
  case 'Demande de prêt':
    $start = 13; $end = 15;
    break;
  case 'Conseil financier':
  case 'Service client':
    $start = 9; $end = 15;
    break;
  default:
    echo json_encode([]);
    exit;
}

// Créer les créneaux horaires (tranches de 30 minutes)
for ($h = $start; $h <= $end; $h++) {
  foreach (['00', '30'] as $min) {
    $horaires[] = sprintf("%02d:%s", $h, $min);
  }
}

// Récupérer les heures déjà réservées ce jour-là et pour ce type
$stmt = $pdo->prepare("SELECT heure_rdv FROM rendezvous WHERE date_rdv = ? AND type_rdv = ?");
$stmt->execute([$date, $type]);
$heures_prises = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Retirer les créneaux déjà pris
$heures_disponibles = array_values(array_diff($horaires, $heures_prises));

echo json_encode($heures_disponibles);
?>
