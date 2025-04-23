<?php
session_start();

// Stockage de l'étape 3
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['telephone'] = $_POST['telephone'];
}

// Vérification de session complète
$champs = ['emplacement', 'prestation', 'representant', 'date', 'heure', 'nom', 'email', 'telephone'];
foreach ($champs as $champ) {
    if (!isset($_SESSION[$champ])) {
        die("Erreur : informations manquantes. Veuillez recommencer depuis le début.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap JS Bundle (inclut Popper.js) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
         .body{
        font-family: 'Poppins', sans-serif;
      }
        .step-icon { width: 40px; height: 40px; border-radius: 50%; background-color: #ddd; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; }
        .active-step { background-color: green; color: white; }
        .wizard-step { text-align: center; margin-bottom: 2rem; }
        .btn-confirm { background-color: green; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="text-center mb-4">
<h3>Mon Rendez-Vous</h3>
        <div class="d-flex justify-content-between wizard-step">
            <div><div class="step-icon">1</div><p>Etape 1</p></div>
            <div><div class="step-icon active-step">2</div><p>Etape 2</p></div>
            <div><div class="step-icon">3</div><p>Etape 3</p></div>
            <div><div class="step-icon">4</div><p>Confirmation</p></div>
        </div>
    </div>

    <div class="card p-4 shadow-sm">
        <h5 class="mb-3">Récapitulatif :</h5>
        <ul class="list-group mb-3">
            <li class="list-group-item">📍 Emplacement : <strong><?= $_SESSION['emplacement'] ?></strong></li>
            <li class="list-group-item">🧾 Prestation : <strong><?= $_SESSION['prestation'] ?></strong></li>
            <li class="list-group-item">👤 Représentant : <strong><?= $_SESSION['representant'] ?: "Indifférent" ?></strong></li>
            <li class="list-group-item">📅 Date : <strong><?= $_SESSION['date'] ?></strong></li>
            <li class="list-group-item">⏰ Heure : <strong><?= $_SESSION['heure'] ?></strong></li>
            <li class="list-group-item">👨‍💼 Nom : <strong><?= $_SESSION['nom'] ?></strong></li>
            <li class="list-group-item">📧 Email : <strong><?= $_SESSION['email'] ?></strong></li>
            <li class="list-group-item">📱 Téléphone : <strong><?= $_SESSION['telephone'] ?></strong></li>
        </ul>

        <form action="valider_rdv.php" method="POST">
       
        <a href="etapes2.php"class="btn btn-confirm w-100">Confirmer le rendez-vous</a>
        </form>
    </div>
</div>

</body>
</html>
