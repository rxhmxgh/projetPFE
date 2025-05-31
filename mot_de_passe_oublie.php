<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "banquemoderne");
$erreur = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rib = trim($_POST["ccp"]);

    // Vérifier si le RIB existe
    $stmt = $conn->prepare("SELECT id FROM utilisateurs WHERE ccp = ?");
    $stmt->bind_param("s", $rib);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Générer un nouveau mot de passe aléatoire
        $nouveau_mdp = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);
        $mot_de_passe_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base
        $update = $conn->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE ccp = ?");
        $update->bind_param("ss", $mot_de_passe_hash, $rib);
        $update->execute();

        $success = "Votre nouveau mot de passe est : <strong>$nouveau_mdp</strong>";
    } else {
        $erreur = "RIB non trouvé. Veuillez vérifier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mot de passe oublié</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 50px; }
    .container { max-width: 400px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
    .input-group { margin-bottom: 15px; }
    label { display: block; margin-bottom: 5px; }
    input[type="text"], input[type="submit"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
    .error { color: red; margin-bottom: 10px; }
    .success { color: green; margin-bottom: 10px; }
    a { display: block; margin-top: 20px; text-align: center; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Mot de passe oublié</h2>
    <?php if ($erreur): ?>
      <div class="error"><?= $erreur ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="success"><?= $success ?></div>
    <?php else: ?>
      <form method="POST" action="">
        <div class="input-group">
          <label for="ccp">Entrez votre numéro RIB</label>
          <input type="text" id="ccp" name="ccp" required>
        </div>
        <input type="submit" value="Réinitialiser le mot de passe">
      </form>
    <?php endif; ?>
    <a href="connex.php">← Retour à la connexion</a>
  </div>
</body>
</html>
