


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - Demandes d'ouverture de compte</title>
    <style>

/* Reset simple */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

 body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 20px;
    color: #2c3e50;
}

nav {
        background-color: #333;
       background-color: #333;
  padding: 10px 20px;
    }
    
   nav ul {
  list-style: none;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin: 0;
  padding: 0;
  flex-wrap: wrap; /* Pour s'adapter sur petits écrans */
}
    
    nav ul li {
        display: inline-block;
      
    }
    
    nav ul li a {
        color: white;
        text-decoration: none;
        font-size: 17.5px;
       transition: color 0.3s ease;
    }
    
    nav ul li a:hover {
        text-decoration: underline;
          color: #b0e57c;
    }
h2, h3 {
  color: #34495e;
  text-align: center;
}

.container {
    max-width: 1200px;
    margin: auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px 16px;
    text-align: left;
}

th {
    background-color: #d5f0da;
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #bdc3c7;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #eef6f9;
}

a {
    color:#34495e;
    
}

a:hover {
    text-decoration: underline;
}

.button {
    background-color: #3498db;
    color: white;
    padding: 8px 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
}

.button:hover {
    background-color: #2980b9;
}
    </style>
</head>
<body>
<!-- Menu de navigation -->
<nav>
    <ul>
    <li><a href="admin_rendezvous.php">Rendez-vous</a></li>
        <li><a href="admin_demandeouvrircompteb.php">Compte bancaire</a></li>
        <li><a href="admin_demandes.php">Carte et Chèques</a></li>
        <li><a href="administration.php">Gestion des clients</a></li>
         <li><a href="admin_message.php">Gestion des messages</a></li>
       <li><a href="solde.php">La gestion des soldes</a></li>
          <li><a href="chatbot_admin.php">Les messages du chatbot</a></li>
        <li><a href="logout.php">Déconnecter</a></li>
      
    </ul>
</nav>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");
$stmt = $pdo->query("SELECT * FROM demandes_compte ORDER BY date_demande DESC");
$demandes = $stmt->fetchAll();
?>

<h2>Liste des demandes de comptes bancaires</h2>
<form method="post" action="verifier_dossier.php">
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Type Compte</th>
            <th>Date</th>
            <th>Pièces jointes</th>
            <th>Vérifié</th> <!-- Nouvelle colonne "Vérifié" -->
        </tr>
        <?php foreach ($demandes as $demande): ?>
        <tr>
            <td><?= $demande['id'] ?></td>
            <td><?= $demande['full_name'] ?></td>
            <td><?= $demande['email'] ?></td>
            <td><?= $demande['phone'] ?></td>
            <td><?= $demande['job_status'] ?></td>
            <td><?= $demande['date_demande'] ?></td>
            <td>
                <a href="uploads/<?= $demande['identity_file'] ?>">Identité</a><br>
                <a href="uploads/<?= $demande['extrait_file'] ?>">Extrait</a><br>
                <a href="uploads/<?= $demande['residence_file'] ?>">Résidence</a>
            </td>
            <td>
                <input type="checkbox" name="verified_ids[]" value="<?= $demande['id'] ?>" 
                <?= $demande['is_verified'] ? 'checked' : '' ?>>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <input type="submit" value="Mettre à jour les dossiers vérifiés">
</form>

</body>
</html>