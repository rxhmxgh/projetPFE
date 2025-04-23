<?php
session_start();

// Simulation d'insertion en base de données
$rdv = [
    'emplacement' => $_SESSION['emplacement'],
    'prestation' => $_SESSION['prestation'],
    'representant' => $_SESSION['representant'],
    'date' => $_SESSION['date'],
    'heure' => $_SESSION['heure'],
    'nom' => $_SESSION['nom'],
    'email' => $_SESSION['email'],
    'telephone' => $_SESSION['telephone']
];

// À ce stade, tu peux faire :
// - Une insertion en base de données
// - Un envoi d'email
// - Un enregistrement fichier
// Pour cet exemple, on affiche juste la confirmation :

session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rendez-vous confirmé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap JS Bundle (inclut Popper.js) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 text-center">
        <div class="alert alert-success">
            🎉 Votre rendez-vous a bien été confirmé ! Merci.
        </div>
        <a href="etape1.php" class="btn btn-secondary mt-3">Retour à l'accueil</a>
    </div>
</body>
</html>
