<?php
session_start();

// Stocker les infos de l'étape 1 temporairement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['emplacement'] = $_POST['emplacement'];
    $_SESSION['prestation'] = $_POST['prestation'];
    $_SESSION['representant'] = $_POST['representant'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étape 2 - Choisir la date</title>
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

    <form action="etape3.php" method="POST">
        <div class="mb-3">
            <label for="date" class="form-label">Date du rendez-vous *</label>
            <input type="date" class="form-control" name="date" required>
        </div>
        <div class="mb-3">
            <label for="heure" class="form-label">Heure du rendez-vous *</label>
            <input type="time" class="form-control" name="heure" required>
        </div>

        <div class="text-end">
        <a href="etapes3.php" class="btn btn-next">Prochain</a>
        </div>
    </form>
</div>

</body>
</html>
