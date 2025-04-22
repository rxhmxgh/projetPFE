<?php
// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Connexion à la base de données
$host = "localhost";
$dbname = "BanqueModerne";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire est soumis
$erreur = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $ccp = htmlspecialchars($_POST["ccp"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE ccp = :ccp");
    $stmt->execute(["ccp" => $ccp]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["mot_de_passe"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["prenom"] = $user["prenom"];
        header("Location: moncompte.php");
        exit;
    } else {
        $erreur = "⚠️ Numéro CCP ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion - Banque MYBANK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding-top: 70px;
      background: #f2f2f2;
    }
    .navbar {
      background-color: #0f2d0f !important;
    }
    .navbar-brand {
      color: white !important;
      font-weight: bold;
      font-size: 1.5rem;
    }
    .content {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }
    .login-form {
      max-width: 420px;
      width: 100%;
      padding: 40px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 15px 25px rgba(240, 124, 1, 0.54),
                  0 10px 10px rgba(50, 199, 59, 0.19);
    }
    .form-heading {
      text-align: center;
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 25px;
      color: #333;
    }
    .input-group {
      margin-bottom: 20px;
    }
    .input-group label {
      font-weight: 600;
      color: #58bc82;
      margin-bottom: 5px;
      display: block;
    }
    .input-group input {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .submit {
      width: 100%;
      padding: 12px;
      background-color: #58bc82;
      border: none;
      color: white;
      border-radius: 30px;
      font-weight: bold;
      transition: 0.3s;
    }
    .submit:hover {
      background-color: #45a56b;
    }
    .signup-link {
      margin-top: 20px;
      text-align: center;
    }
    .signup-link a {
      color: #58bc82;
      font-weight: bold;
      text-decoration: none;
    }
    .error-msg {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
      text-align: center;
    }
  </style>
</head>
<body>
  <nav class="navbar fixed-top navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MYBANK Banque</a>
    </div>
  </nav>

  <div class="content">
    <form class="login-form" method="POST" action="">
      <div class="form-heading">Connexion</div>
      <?php if ($erreur): ?>
        <div class="error-msg"><?= $erreur ?></div>
      <?php endif; ?>
      <div class="input-group">
        <label for="ccp">Numéro CCP</label>
        <input type="text" id="ccp" name="ccp" required />
      </div>
      <div class="input-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit" class="submit" name="login">Se connecter</button>
      <div class="signup-link">Pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></div>
    </form>
  </div>
</body>
</html>
