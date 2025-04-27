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
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.balance-section {
    text-align: center;
    padding: 50px 20px;
    background-color: white;
    max-width: 800px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

.balance-section h2 {
    color: #004080;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.users-table th,
.users-table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

.users-table th {
    background-color: #004080;
    color: white;
}

.users-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.btn-credit {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-debit {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-credit:hover {
    background-color: #218838;
}

.btn-debit:hover {
    background-color: #c82333;
}

input[type="number"] {
    width: 80px;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Media Queries pour rendre la page responsive */
@media (max-width: 768px) {
            .balance-section {
                padding: 30px 10px;
                margin: 20px;
            }

            .users-table th,
            .users-table td {
                padding: 8px;
                font-size: 14px;
            }

            .users-table {
                font-size: 14px;
            }

            .btn-credit, .btn-debit {
                padding: 8px 16px;
                font-size: 14px;
            }

            .balance-section h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .balance-section {
                padding: 20px 10px;
                margin: 10px;
            }

            .users-table th,
            .users-table td {
                padding: 6px;
                font-size: 12px;
            }

            .btn-credit, .btn-debit {
                padding: 6px 12px;
                font-size: 12px;
            }

            .balance-section h2 {
                font-size: 1.2rem;
            }
        }

    </style>
</head>
<body>
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
    
</body>
</html>
