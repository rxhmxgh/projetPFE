<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque BADRLINE  - Inscription</title>
   <!-- Bootstrap JS Bundle (inclut Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

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



/* Container principal du formulaire */

.signup-section .card {
  background: rgba(255, 255, 255, 0.95);
  border-radius: 15px;
  padding: 40px;
  max-width: 700px;
  margin: auto;
 /* box-shadow:
    0 15px 25px rgba(240, 124, 1, 0.54), 
    0 10px 10px rgba(50, 199, 59, 0.19);  */

  animation: fadeIn 1.2s ease-out;
}

/* Animation d'entrée */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
/* Titres */
.signup-section h2,
.signup-section legend {

  text-align: center;
  font-weight: 600;
  color: #222;
  margin-bottom: 20px;
  text-transform: uppercase;
}

fieldset {
  border: 2px solid #e0e0e0;
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 25px;
  background-color: #fdfdfd;
}
/* Légendes des fieldsets */
legend {
  font-size: 1.1rem;
  color: #58bc82;
  font-weight: 600;
  font-size: 1rem;
}

/* Champs de formulaire */
.form-label {
  color: #58bc82;
  font-weight: 500;
  font-size: 0.95rem;
}

.form-control {
  padding: 12px 16px;
  border-radius: 10px;
  border: 2px solid #e0e0e0;
  transition: all 0.3s ease;
  background-color: #f9f9f9;
  font-size: 1rem;
}

.form-control:focus {
  border-color: #58bc82;
  box-shadow: 0 0 10px rgba(88, 188, 130, 0.3);
  background-color: #fff;
  outline: none;
}

/* Bouton inscription */
.btn-success {
  background-color: #58bc82;
  border: none;
  border-radius: 30px;
  padding: 12px;
  font-size: 1.1rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background-color: #45a56b;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(88, 188, 130, 0.3);
  box-shadow: 0 5px 15px rgba(88, 188, 130, 0.3);
}

/* Lien vers connexion */
.text-center a {
  color: #58bc82;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}

.text-center a:hover {
  color: #45a56b;
  text-decoration: underline;
}

/* Animation douce */
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

/* Responsive */
@media (max-width: 576px) {
  .signup-section .card {
    padding: 20px;
  }
}

.content {
  padding: 50px 30px;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
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
    <a class="navbar-brand" href="acceuil.php">BADRLINE  Banque</a>
</div>
</nav>

<!-- partie principale -->
<div class="content ">
<section id="inscription" class="signup-section py-5">
  <div class="container">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 700px;">
      <h2 class="text-center mb-4">Créer un compte bancaire</h2>
      <form method="POST" action="">
        <fieldset class="border p-3 mb-3 rounded">
          <legend class="float-none w-auto px-3">Informations Personnelles</legend>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="col-12 mb-3">
              <label for="adresse" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Votre adresse" required>
            </div>
          </div>
        </fieldset>

        <fieldset class="border p-3 mb-3 rounded">
          <legend class="float-none w-auto px-3">Informations Bancaires</legend>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="ccp" class="form-label">Numéro CCP</label>
              <input type="text" class="form-control" id="ccp" name="ccp" placeholder="Numéro CCP" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cle-ccp" class="form-label">Clé CCP</label>
              <input type="text" class="form-control" id="cle-ccp" name="cle-ccp" placeholder="Clé CCP" required>
            </div>
          </div>
        </fieldset>

        <fieldset class="border p-3 mb-3 rounded">
          <legend class="float-none w-auto px-3">Coordonnées</legend>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="telephone" class="form-label">Numéro de téléphone</label>
              <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Votre numéro" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Votre e-mail" required>
            </div>
          </div>
        </fieldset>

        <fieldset class="border p-3 mb-3 rounded">
          <legend class="float-none w-auto px-3">Mot de passe</legend>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirmer le mot de passe" required>
            </div>
          </div>
        </fieldset>

        <p class="text-center">Vous avez déjà un compte ? <a href="connex.php">Connectez-vous ici</a></p>
        <div class="d-grid">
          <button type="submit" name="register" class="btn btn-success">S'inscrire</button>
        </div>
      </form>
    </div>
  </div>
</section>
</div>

<!-- partie php -->
<?php
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
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $ccp = htmlspecialchars($_POST["ccp"]);
    $cle_ccp = htmlspecialchars($_POST["cle_ccp"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hachage sécurisé du mot de passe

    try {
        // Vérifier si l'email ou le CCP existent déjà
        $checkQuery = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email OR ccp = :ccp");
        $checkQuery->execute(["email" => $email, "ccp" => $ccp]);
        if ($checkQuery->rowCount() > 0) {
            echo "⚠️ Cet email ou numéro CCP est déjà utilisé.";
            exit;
        }

        // Insérer les données
        $sql = "INSERT INTO utilisateurs (nom, prenom, adresse, ccp, cle_ccp, telephone, email, mot_de_passe) 
                VALUES (:nom, :prenom, :adresse, :ccp, :cle_ccp, :telephone, :email, :mot_de_passe)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "nom" => $nom,
            "prenom" => $prenom,
            "adresse" => $adresse,
            "ccp" => $ccp,
            "cle_ccp" => $cle_ccp,
            "telephone" => $telephone,
            "email" => $email,
            "mot_de_passe" => $password
        ]);

        echo "✅ Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } catch (PDOException $e) {
        echo "❌ Erreur : " . $e->getMessage();
    }
}
?>

</body>
</html>
