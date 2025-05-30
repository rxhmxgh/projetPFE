<?php



error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'banquemoderne';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les rendez-vous
$stmt = $pdo->query("SELECT * FROM rendezvous ORDER BY date_rdv, heure_rdv");

$rendezvous = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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


<body class="bg-light">

<div class="container mt-5">
    <div class="text-center mb-4 text-primary"> 

        <?php if (count($rendezvous) > 0): ?>
        
        <h2>Liste des rendez-vous planifiés</h2>

        <table class="table table-bordered table-hover bg-white shadow">
            <thead class="table-success">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rendezvous as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['nom']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars($r['telephone']) ?></td>
                    <td><?= htmlspecialchars($r['type_rdv']) ?></td>
                    <td><?= htmlspecialchars($r['date_rdv']) ?></td>
                    <td><?= htmlspecialchars($r['heure_rdv']) ?></td>
                    <td>
                        <?php if ($r['statut'] === 'confirme'): ?>
                            <span class="badge bg-success">Confirmé</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">En attente</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($r['statut'] === 'en_attente'): ?>
                            <a href="confirmer_rdv.php?id=<?= $r['id'] ?>" class="btn btn-success btn-sm">Confirmer</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php else: ?>
            <p class="text-center">Aucun rendez-vous enregistré pour le moment.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
