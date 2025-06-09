<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "banquemoderne";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_question'])) {
    $question = $conn->real_escape_string($_POST['user_question']);
    $conn->query("INSERT INTO questions (user_question) VALUES ('$question')");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Récupération des questions et réponses
$questions = $conn->query("SELECT user_question, admin_response FROM questions ORDER BY created_at ASC");
?>

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
    <title>Demande d'ouvrir un compte bancaire</title>
 <style>
    /* style.css */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
    border-radius: 10px;
    margin-bottom: 30px;
}

h1 {
    text-align: center;
    color: #333;
}

h2 {
    color: #444;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color:rgb(249, 173, 32) !important;
    color: white !important;
    padding: 8px  !important;
    border: none !important;
    border-radius: 15px !important;
    cursor: pointer !important;
    font-size: 16px !important;
}

button:hover {
    background-color:rgb(255, 169, 8);
}

textarea {
    height: 100px;
}

input[type="file"] {
    padding: 5px;
}


/* css pour formulaire */
.center-section {
    text-align: center;
    margin: 0 auto;
    padding: 30px;
    max-width: 600px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.download-btn {
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 15px;
    margin-top: 10px;
    font-weight: bold;
}

.download-btn:hover {
    background-color: #218838;
}


</style>
</head>
<body>

<div class="container" id="envoyé">
    <h1>Demande d'ouvrir un compte bancaire</h1>
    <p>Remplissez le formulaire ci-dessous pour soumettre votre demande.</p>

    <form action="demande.php" method="POST" enctype="multipart/form-data">
        
        <!-- Informations personnelles -->
        <h2>Informations Personnelles</h2>
        <label for="full_name">Nom complet :</label>
        <input type="text" id="full_name" name="full_name" required>
        
        <label for="dob">Date de naissance :</label>
        <input type="date" id="dob" name="dob" required>
        
        <script>
  // Calcul de la date maximale autorisée (18 ans en arrière)
  const today = new Date();
  const year = today.getFullYear() - 18;
  const month = String(today.getMonth() + 1).padStart(2, '0');
  const day = String(today.getDate()).padStart(2, '0');
  const maxDate = `${year}-${month}-${day}`;

  // On fixe cette date comme limite maximale dans le champ
  document.getElementById("dob").max = maxDate;
</script>

       <input type="tel" id="phone" name="phone" required 
       pattern="^0[5-7][0-9]{8}$"
       oninvalid="this.setCustomValidity('Le numéro doit commencer par 05, 06 ou 07 et contenir 10 chiffres.')"
       oninput="this.setCustomValidity('')"
       placeholder="Ex: 06XXXXXXXX">
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        



        <!-- Tpe de compte -->
        <h2>Type de compte</h2>
        <label for="job_status">Type à choisir:</label>
        <select id="job_status" name="job_status" required>
            <option value="salarié">Compte Courant</option>
            <option value="indépendant">Compte d'Épargne</option>
            <option value="retraité">Compte Joint</option>
        </select>


        <!-- Documents à fournir -->
        <h2>Documents à Fournir</h2>
        <label for="identity_proof">Pièce d'identité :</label>
        <input type="file" id="identity_proof" name="identity_proof" required>

        <label for="income_proof">Extrer de naissance :</label>
        <input type="file" id="income_proof" name="income_proof" required>

        <label for="address_proof">La récidence :</label>
        <input type="file" id="address_proof" name="address_proof" required>

        <!-- Consentement et Soumission -->
        <h2>Consentement</h2>
        <label>
            <input type="checkbox" name="consent" required>
            J'accepte que mes informations soient utilisées conformément à la politique de confidentialité de la banque.
        </label>
        
        <button type="submit">Envoyer ma demande</button>
    </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function () {
      alert("✅ Votre demande est en cours d’envoi. Merci !");
    });
  });
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $full_name = $_POST['full_name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $job_status = $_POST['job_status'] ?? '';
    $consent = isset($_POST['consent']) ? 1 : 0;

    // Fichiers
    $identity_proof = $_FILES['identity_proof'] ?? null;
    $extrait_proof = $_FILES['income_proof'] ?? null;
    $residence_proof = $_FILES['address_proof'] ?? null;
// Sauvegarde dans la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO demandes_compte 
        (full_name, dob, phone, email, address, job_status, identity_file, extrait_file, residence_file, consentement) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $full_name,
        $dob,
        $phone,
        $email,
        $address,
        $job_status,
        $identity_proof['name'] ?? '',
        $extrait_proof['name'] ?? '',
        $residence_proof['name'] ?? '',
        $consent
    ]);

    echo "<br>✅ Les données ont été enregistrées avec succès dans la base.";
} catch (PDOException $e) {
    echo "❌ Erreur de base de données : " . $e->getMessage();
}
}
?>

<!-- telecharger document -->
<div class="center-section">
    <h2>Télécharger le Formulaire PDF</h2>
    <p>Veuillez télécharger, remplir, puis joindre ce formulaire à votre demande si nécessaire :</p>
    
    <a href="formaulaire.pdf" download class="download-btn">📄 Télécharger le formulaire</a>

   
</div>

<!-- partie php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs sont remplis
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $loan_amount = $_POST['loan_amount'];
    $loan_duration = $_POST['loan_duration'];
    $loan_type = $_POST['loan_type'];
    $loan_purpose = $_POST['loan_purpose'];
    $job_status = $_POST['job_status'];
    $monthly_income = $_POST['monthly_income'];
    $monthly_expense = $_POST['monthly_expense'];
    
    // Traitement des fichiers téléchargés
    $identity_proof = $_FILES['identity_proof'];
    $Extrer_proof = $_FILES['income_proof'];
    $récidence_proof = $_FILES['address_proof'];

    // Vérifier que l'utilisateur a accepté les termes
    if (isset($_POST['consent'])) {
        // Vérification des fichiers téléchargés
        $target_dir = "uploads/"; // Répertoire où les fichiers seront stockés

        // Créer le répertoire si nécessaire
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Fonction pour gérer le téléchargement des fichiers
        function handleFileUpload($file, $target_dir) {
            $target_file = $target_dir . basename($file["name"]);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Vérifier la taille du fichier
            if ($file["size"] > 5000000) { // Limiter à 5MB
                return "Le fichier est trop volumineux.";
            }

            // Vérifier le type de fichier (ici, on accepte les images et les PDF)
            if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "pdf") {
                return "Seuls les fichiers JPG, JPEG, PNG et PDF sont autorisés.";
            }

            // Télécharger le fichier
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return "Le fichier " . htmlspecialchars(basename($file["name"])) . " a été téléchargé avec succès.";
            } else {
                return "Erreur lors du téléchargement du fichier.";
            }
        }

        // Télécharger les documents
        $identity_msg = handleFileUpload($identity_proof, $target_dir);
        $Exter_msg = handleFileUpload($Extrer_proof, $target_dir);
        $récidence_msg = handleFileUpload($récidence_proof, $target_dir);

        echo "Votre demande a été soumise avec succès. Voici les résultats des fichiers téléchargés :<br>";
        echo "Pièce d'identité : $identity_msg<br>";
        echo "Extrer de naissance : $Extrer_msg<br>";
        echo "La récidence: $récidence_msg<br>";

        // Vous pouvez également enregistrer ces informations dans une base de données ici
    } else {
        echo "Vous devez accepter les termes et conditions pour soumettre votre demande.";
    }
} else {
    echo "Aucune donnée soumise.";
}
?>



 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
