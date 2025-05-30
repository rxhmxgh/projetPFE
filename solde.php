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

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = intval($_POST["id"]);
    $montant = floatval($_POST["montant"]);
    $action = $_POST["action"];

    if ($montant > 0) {
        try {
            // Récupérer le solde actuel
            $stmt = $pdo->prepare("SELECT solde FROM utilisateurs WHERE id = :id");
            $stmt->execute(["id" => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $soldeActuel = $user["solde"];
                
                if ($action == "crediter") {
                    $nouveauSolde = $soldeActuel + $montant;
                } elseif ($action == "debiter") {
                    if ($montant > $soldeActuel) {
                        echo "⚠️ Solde insuffisant pour débiter ce montant.";
                        exit;
                    }
                    $nouveauSolde = $soldeActuel - $montant;
                }

                // Mettre à jour le solde
                $updateStmt = $pdo->prepare("UPDATE utilisateurs SET solde = :solde WHERE id = :id");
                $updateStmt->execute(["solde" => $nouveauSolde, "id" => $userId]);

                echo "✅ Solde mis à jour avec succès.";
            } else {
                echo "❌ Utilisateur introuvable.";
            }
        } catch (PDOException $e) {
            echo "❌ Erreur : " . $e->getMessage();
        }
    } else {
        echo "⚠️ Le montant doit être supérieur à zéro.";
    }
}
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Soldes - Banque Moderne</title>
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

/* Contenu principal */
.content {
     max-width: 1200px;
    margin: auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
/* partie tableau */ 

.balance-section {
    padding: 20px;
    background-color: #f9f9f9;
}

.balance-section h2 {

    margin-bottom: 20px;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.users-table th {
    background-color: #2c662d;
    color: white;
    padding: 12px;
    text-align: left;
}

.users-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.users-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.users-table input[type="number"] {
    padding: 5px;
    width: 100px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 5px;
}

.btn-credit {
    background-color: green;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 5px;
}

.btn-debit {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-credit:hover {
    background-color:rgb(25, 87, 26);
}

.btn-debit:hover {
    background-color: #c9302c;
}

/*recherche */
.search-form {
    margin-bottom: 20px;
    text-align: right;
    padding: 20px;
}

.search-form input[type="text"] {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 250px;
    margin-right: 10px;
}

.search-form button {
    background-color: #2c662d;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-form button:hover {
    background-color: #245123;
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

<form method="get" class="search-form">
    <input type="text" name="rib" placeholder="Rechercher par RIB..." value="<?php echo isset($_GET['rib']) ? htmlspecialchars($_GET['rib']) : ''; ?>">
    <button type="submit">Rechercher</button>
</form>
<!-- Contenu -->
 <div class="content">
    <section class="balance-section">
        <h2>Gestion des Soldes</h2>
        <table class="users-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro RIB</th>
                    <th>Solde (DA)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer tous les utilisateurs
               if (isset($_GET['rib']) && !empty(trim($_GET['rib']))) {
    $rib = trim($_GET['rib']);
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE ccp LIKE ?");
    $stmt->execute(["%$rib%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM utilisateurs");
}
                while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($user['nom']) . "</td>
                            <td>" . htmlspecialchars($user['prenom']) . "</td>
                            <td>" . htmlspecialchars($user['ccp']) . "</td>
                            <td>" . htmlspecialchars($user['solde']) . " DA</td>
                            <td>
                                <form method='post' action=''>
                                    <input type='hidden' name='id' value='" . $user['id'] . "'>
                                    <input type='number' name='montant' placeholder='Montant' required>
                                    <button type='submit' name='action' value='crediter' class='btn-credit'>Créditer</button>
                                    <button type='submit' name='action' value='debiter' class='btn-debit'>Débiter</button>
                                </form>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
  </div>

</body>
</html>
