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
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus, input[type="email"]:focus {
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
}

button:hover {
    background-color: #0056b3;
}

</style>
<?php
$pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");

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
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);

    $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
        'id' => $id
    ]);

    echo "<script>alert('Client modifié avec succès.'); window.location.href='administration.php';</script>";
}
?>

<h2>Modifier le client</h2>
<form method="POST">
    <label>Nom : <input type="text" name="nom" value="<?= $client['nom'] ?>" required></label><br><br>
    <label>Prénom : <input type="text" name="prenom" value="<?= $client['prenom'] ?>" required></label><br><br>
    <label>Email : <input type="email" name="email" value="<?= $client['email'] ?>" required></label><br><br>
    <label>Téléphone : <input type="text" name="telephone" value="<?= $client['telephone'] ?>" required></label><br><br>
    <button type="submit" name="modifier">Enregistrer</button>
</form>
