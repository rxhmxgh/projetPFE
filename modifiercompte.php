<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connex.php");
    exit();
}

$id = $_SESSION['user_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banquemoderne";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$errors = [];
$success = "";

// Récupérer les infos actuelles
$sql = "SELECT email, telephone FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($email, $telephone);
$stmt->fetch();
$stmt->close();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $new_telephone = trim($_POST['telephone']);
    $new_password = trim($_POST['password']);
    $new_password_confirm = trim($_POST['password_confirm']);

    if (!$new_email) {
        $errors[] = "Adresse email invalide.";
    }

    if (empty($new_telephone)) {
        $errors[] = "Le numéro de téléphone est requis.";
    }

    if (!empty($new_password)) {
        if ($new_password !== $new_password_confirm) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } elseif (strlen($new_password) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }
    }

    // Si aucune erreur, faire la mise à jour
    if (empty($errors)) {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE utilisateurs SET email = ?, telephone = ?, mot_de_passe = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $new_email, $new_telephone, $hashed_password, $id);
        } else {
            $sql = "UPDATE utilisateurs SET email = ?, telephone = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $new_email, $new_telephone, $id);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Votre compte a été mis à jour avec succès.";
            header("Location: moncompte.php");
            
            exit();
        } else {
               
            $errors[] = "Erreur lors de la mise à jour.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Modifier mon compte</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Modifier mon compte</h2>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="moncompte.php" class="mt-4">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($telephone ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" minlength="6">
        </div>

        <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" minlength="6">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>

</html>
