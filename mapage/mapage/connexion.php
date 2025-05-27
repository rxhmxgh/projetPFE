<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Banque Badr- Connexion</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #004080;
    color: white;
}

.header .logo img {
    height: 50px;
}

.nav a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-size: 16px;
}

.nav a:hover {
    text-decoration: underline;
}

.login-section {
    text-align: center;
    padding: 50px;
    background-color: white;
    max-width: 400px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #004080;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #002855;
}

.no-account {
    margin-top: 15px;
}

.no-account a {
    color: #004080;
    text-decoration: none;
}

.no-account a:hover {
    text-decoration: underline;
}

.footer {
    text-align: center;
    padding: 20px;
    background-color: #004080;
    color: white;
    margin-top: 50px;
}

    </style>
</head>
<body>

    <header class="header">
        <div class="logo">
            <img src="img/logo.webp" alt="Logo Banque Moderne">
        </div>
        <nav class="nav">
            <a href="accueil.html">Accueil</a>
            <a href="signup.php">S'inscrire</a> <!-- Correction ici -->
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <section id="connexion" class="login-section">
        <h2>Connexion à votre compte</h2>
        <form action="" method="post" class="login-form">
            <div class="form-group">
                <label for="ccp">Numéro CCP</label>
                <input type="text" id="ccp" name="ccp" placeholder="Votre numéro CCP" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>
        <p class="no-account">Pas encore de compte ? <a href="signup.php">Inscrivez-vous ici</a></p>
    </section>
    
    <footer class="footer">
        <p>&copy; 2025 Banque Moderne. Tous droits réservés.</p>
    </footer>

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
