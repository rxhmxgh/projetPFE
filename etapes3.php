<?php
session_start();

// Stocker les infos de l'étape 2
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['heure'] = $_POST['heure'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étape 3 - Vos Informations</title>
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
        .btn-next { background-color: green; color: white; }
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

    <form action="etape4.php" method="POST">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom complet *</label>
            <input type="text" class="form-control" name="nom" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email *</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone *</label>
            <input type="tel" class="form-control" name="telephone" required pattern="[0-9]{10,}">
        </div>

        <div class="text-end">
        <a href="etapes4.php" class="btn btn-next">Prochain</a>
        </div>
    </form>
</div>

</body>
</html>
