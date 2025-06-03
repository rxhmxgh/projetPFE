<style>
/* Structure de base */
body {
    background-color: #f4f7fc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

/* Formulaire de modification */
h2 {
    text-align: center;
    font-size: 28px;
    color: #007bff;
    margin-bottom: 30px;
}

h3 {
    color: #007bff;
    margin-top: 30px;
    font-size: 20px;
}

/* Formulaire */
form {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
}

label {
    font-weight: 600;
    color: #495057;
    display: block;
    margin-bottom: 5px;
}

input[type="text"], 
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus, 
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    width: 100%;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

.small-text {
    font-size: 12px;
    color: #6c757d;
    margin-bottom: 15px;
    display: block;
}

.password-container {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}
</style>

<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérification CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Récupération des données du client
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        echo "Client introuvable.";
        exit;
    }
}


 // Mise à jour après soumission
if (isset($_POST['modifier'])) {
    // Vérification CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur de sécurité: Token CSRF invalide");
    }

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);

    try {
        $pdo->beginTransaction();

        // Mise à jour des informations de base
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'id' => $id
        ]);

        // Traitement du changement de mot de passe si fourni
        if ( !empty($_POST['ancien_mdp'] )) {
            $ancien_mdp = $_POST['ancien_mdp'];
            $nouveau_mdp = $_POST['nouveau_mdp'];
            $confirmation_mdp = $_POST['confirmation_mdp'];

            // Vérification que le nouveau mot de passe et sa confirmation correspondent
            if ($nouveau_mdp !== $confirmation_mdp) {
                throw new Exception("Les nouveaux mots de passe ne correspondent pas.");
            }
        
            // Vérification de la force du mot de passe
            if (strlen($nouveau_mdp) < 8 || !preg_match("/[A-Z]/", $nouveau_mdp) || 
                !preg_match("/[a-z]/", $nouveau_mdp) || !preg_match("/[0-9]/", $nouveau_mdp)) {
                throw new Exception("Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un chiffre.");
            }

            // Vérification de l'ancien mot de passe
            $stmt = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs WHERE id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch();

            if (!password_verify($ancien_mdp, $user['mot_de_passe'])) {
                throw new Exception("Ancien mot de passe incorrect.");
            }

            // Hachage du nouveau mot de passe
            $nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

            // Mise à jour du mot de passe
            $stmt = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?");
            $stmt->execute([$nouveau_mdp_hash, $id]);
        }

        $pdo->commit();

        $origine = $_GET['from'] ?? 'admin';
        $message = isset($_POST['ancien_mdp']) ? 
            "Informations et mot de passe mis à jour avec succès." : 
            "Informations mises à jour avec succès.";

        if ($origine === 'client') {
            echo "<script>alert('$message'); window.location.href='moncompte.php';</script>";
        } else {
            echo "<script>alert('$message'); window.location.href='administration.php';</script>";
        }

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<script>alert('Erreur: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>

<h2>Modifier le client</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>
    
    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>
    
    <label>Email :</label>
    <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
    
    <label>Téléphone :</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required>
    
    <div class="password-container">
        <h3>Changer le mot de passe</h3>
        <span class="small-text">Remplissez uniquement si vous souhaitez modifier votre mot de passe</span>
        
        <label>Ancien mot de passe :</label>
        <input type="password" name="ancien_mdp">
        
        <label>Nouveau mot de passe :</label>
        <input type="password" name="nouveau_mdp">
        <span class="small-text">Minimum 8 caractères avec au moins une majuscule, une minuscule et un chiffre</span>
        
        <label>Confirmer le nouveau mot de passe :</label>
        <input type="password" name="confirmation_mdp">
    </div>
    
    <button type="submit" name="modifier">Enregistrer les modifications</button>
 </form>