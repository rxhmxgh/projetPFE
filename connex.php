<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap JS Bundle (inclut Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <title>Banque EL-BADR - Connexion</title>
   <style>
   body {
    font-family: 'Poppins', sans-serif;
    height: 100%;
    position: relative;
    overflow-x: hidden;
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

/* Smartphones */
@media (max-width: 600px) {
    .container {
        padding: 1rem;
    }
    .menu {
        flex-direction: column;
    }
}

/* Tablettes */
@media (min-width: 601px) and (max-width: 1024px) {
    .container {
        padding: 2rem;
    }
}
 
@media (max-width: 768px) {
    .container {
        padding: 0.5rem;
    }
}


/* navbar style */
.navbar {
    background-color: #0f2d0f !important; /* Vert foncé */
    padding: 10px 20px;
    position: fixed;
    top: 0;
}

.navbar-brand {
    color: white !important;
    font-weight: bold;
    font-size: 1.5rem;
}

.navbar-nav .nav-link {
    color: white !important;
    font-size: 1rem;
    margin-right: 15px;
}

.navbar-nav .nav-link:hover {
    text-decoration: underline;
    transform: scale(1.1);
}



/* partie login */
/* From Uiverse.io by rajesh_4474 */ 
/* login form by rajesh_4474 */
@keyframes gradientBackground {
  4% {
    background: linear-gradient(135deg, #222831, #393E46);
  }
  50% {
    background: linear-gradient(135deg, #1F1F1F, #2D2D2D);
  }
  100% {
    background: linear-gradient(135deg, #222831, #393E46);
  }
}

.login-form {
  max-width: 420px;
  width: 100%;
  padding: 40px;
  background: rgba(255, 255, 255, 0.92);
  border-radius: 12px;
  box-shadow:
    0 15px 25px rgba(240, 124, 1, 0.54), /* ombre principale plus foncée */
    0 10px 10px rgba(50, 199, 59, 0.19); /* effet de profondeur */
  animation: fadeIn 1.5s ease-out;
  position: relative;
  z-index: 2;
}

.form-heading {
  text-align: center;
  color: #333;
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 25px;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.input-group {
  position: relative;
  margin-bottom: 20px;
}

.input-group .label {
  position: absolute;
  top: -16px;
  left: 12px;
  font-size: 12px;
  color: #58bc82;
  font-weight: 600;
  transition: all 0.3s ease;
  opacity: 0.7;
}

.input-group input {
  width: 100%;
  padding: 15px 20px;
  font-size: 1rem;
  color: #333;
  background-color: #f5f5f5;
  border: 2px solid #ddd;
  border-radius: 10px;
  outline: none;
  transition: all 0.3s ease;
}

.input-group input:focus {
  border-color: #58bc82;
  box-shadow: 0 0 10px rgba(88, 188, 130, 0.4);
}

.input-group input:focus + .label {
  top: -20px;
  font-size: 11px;
  color: #58bc82;
  opacity: 1;
}

.forgot-password {
  text-align: right;
  margin-bottom: 20px;
}

.forgot-password a {
  font-size: 14px;
  color: #58bc82;
  text-decoration: none;
  transition: color 0.3s ease;
}

.forgot-password a:hover {
  color: #45a56b;
}

.submit {
  width: 100%;
  padding: 15px;
  background-color: #58bc82;
  color: #fff;
  border: none;
  border-radius: 30px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.submit:hover {
  background-color: #45a56b;
  transform: translateY(-2px);
  box-shadow: 0 5px 20px rgba(88, 188, 130, 0.3);
}

.signup-link {
  text-align: center;
  font-size: 14px;
  color: #333;
}

.signup-link a {
  color: #58bc82;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}

.signup-link a:hover {
  color: #45a56b;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: scale(0.9);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

@media (max-width: 480px) {
  .login-form {
    padding: 30px;
    width: 90%;
  }
}



.content {
    padding: 50px 30px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.main-content {
  flex: 1;
}

</style>
</head>
<body>

<!-- partie menu  -->

<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="acceuil.php">EL-BADR Banque</a>
</div>
</nav>

<div class="content ">
  <!-- From Uiverse.io by rajesh_4474 --> 
<form class="login-form">
  <div class="form-heading">CONNEXION</div>
  <div class="input-group">
    <label class="label" for="email">Numéro</label>
    <input
      required=""
      placeholder="Entrer votre numéro"
      name="email"
      id="email"
      type="email"
    />
  </div>
  <div class="input-group">
    <label class="label" for="password">Mot de passe</label>
    <input
      required=""
      placeholder="Entrer votre mot de passe"
      name="password"
      id="password"
      type="password"
    />
  </div>

  <button class="submit" type="submit">Se connecter</button>
  <div class="signup-link">Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a></div>
</form>
 
    </div>
  <!-- php -->
  <?php
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ccp = htmlspecialchars($_POST["ccp"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE ccp = :ccp");
    $stmt->execute(["ccp" => $ccp]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["mot_de_passe"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["prenom"] = $user["prenom"];
        header("Location: bonjour.php"); // Changer vers la page dashboard
        exit;
    } else {
        echo "⚠️ Numéro CCP ou mot de passe incorrect.";
    }
}
?>
</body>
</html>
