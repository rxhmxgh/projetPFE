
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
    <title>Gérer les Soldes - Banque Badr</title>
<style>
    /* Styles généraux */
    body {
        font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: black;
            background: #f3e8d3;
            font-family: 'Poppins', sans-serif;
        }

/* Section principale */
.balance-section {
    max-width: 1000px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.balance-section h2 {
    color: #004080;
    margin-bottom: 20px;
    font-size: 28px;
}

/* Table */
.users-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.users-table th, .users-table td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: center;
}

.users-table th {
    background-color: #004080;
    color: white;
    font-weight: bold;
}

.users-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.users-table tr:hover {
    background-color: #f1f1f1;
}

/* Boutons */
.btn-credit {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-credit:hover {
    background-color: #218838;
}

.btn-debit {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-debit:hover {
    background-color: #c82333;
}

.btn-history {
    background-color: #007bff;
    color: white;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 5px;
    display: inline-block;
    transition: 0.3s;
}

.btn-history:hover {
    background-color: #0056b3;
}

/* Champs de formulaire */
input[type="number"] {
    padding: 8px;
    width: 100px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="number"]:focus {
    outline: none;
    border-color: #004080;
    box-shadow: 0 0 5px rgba(0, 64, 128, 0.3);
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

/* Animation du menu latéral (offcanvas) */
.offcanvas {
    background-color: #0f2d0f !important;
    transform: translateX(-100%);
    transition: transform 0.5s ease-in-out;
}

.offcanvas.show {
    transform: translateX(0);
}

/* Styles des éléments du menu latéral */
.offcanvas-body .nav-item {
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s;
}

.offcanvas-body .nav-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: scale(1.05);
}

/* Éléments actifs */
.offcanvas-body .nav-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

/* Menu déroulant */
.dropdown-menu {
    background-color: #0c1f0c;
    animation: fadeIn 0.3s ease-in-out;
}

.dropdown-menu .dropdown-item {
    color: white;
    transition: background-color 0.3s ease-in-out;
}

.dropdown-menu .dropdown-item:hover {
    background-color: #1a3d1a;
}


/* Animation de fondu */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Effet sur le bouton de fermeture */

.btn-close-white {
    filter: invert(1);
}

.btn-close-white:hover {
    transform: rotate(180deg);
}
.banner {
            padding: 60px;
            text-align: center;
            margin: 30px;
        }
        .banner h2 {
            font-size: 32px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #f0a500;
            border: none;
        }
        .btn-primary:hover {
            background-color: #d98e00;

        }
        .btn-clicked {
            background-color: #28a745 !important; /* Vert */
            color: white;
        }
        .row {
            margin-top: 30px;
        }


        
</style>
</head>
<body>

<!-- partie menu  -->

<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EL-BADR Banque</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">MENU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="acceuil.php">accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadPage('simulateur')">Simulation des crédits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadPage('produits')">Produits bancaires</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="gerer.php">Relever</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gerer.php">Historique</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.php">Les services bancaire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadPage('map')">Map</a>
          </li> 
                   <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadPage('compte')">Mon compte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Se déconnecter</a>
          </li>
             
      </div>
    </div>
  </div>
</nav>

<!-- le contenu -->
    <section class="balance-section">
        <h2>Gestion des Soldes</h2>
        <table class="users-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro CCP</th>
                    <th>Solde (DA)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer tous les utilisateurs
                $stmt = $pdo->query("SELECT * FROM utilisateurs");
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
            // Commencer la transaction
            $pdo->beginTransaction();

            // Récupérer le solde actuel
            $stmt = $pdo->prepare("SELECT solde FROM utilisateurs WHERE id = :id");
            $stmt->execute(["id" => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $soldeActuel = $user["solde"];
                
                if ($action == "crediter") {
                    $nouveauSolde = $soldeActuel + $montant;
                    $typeTransaction = 'credit';
                } elseif ($action == "debiter") {
                    if ($montant > $soldeActuel) {
                        echo "⚠️ Solde insuffisant pour débiter ce montant.";
                        exit;
                    }
                    $nouveauSolde = $soldeActuel - $montant;
                    $typeTransaction = 'debit';
                }

                // Mettre à jour le solde
                $updateStmt = $pdo->prepare("UPDATE utilisateurs SET solde = :solde WHERE id = :id");
                $updateStmt->execute(["solde" => $nouveauSolde, "id" => $userId]);

                // Enregistrer la transaction
                $transactionStmt = $pdo->prepare("INSERT INTO transactions (utilisateur_id, type, montant) VALUES (:utilisateur_id, :type, :montant)");
                $transactionStmt->execute([
                    "utilisateur_id" => $userId,
                    "type" => $typeTransaction,
                    "montant" => $montant
                ]);

                // Valider la transaction
                $pdo->commit();
                echo "✅ Solde mis à jour et transaction enregistrée.";
            } else {
                echo "❌ Utilisateur introuvable.";
            }
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $pdo->rollBack();
            echo "❌ Erreur : " . $e->getMessage();
        }
    } else {
        echo "⚠️ Le montant doit être supérieur à zéro.";
    }
}
?>

</body>
</html>

