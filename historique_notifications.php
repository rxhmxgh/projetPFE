<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli("localhost", "root", "", "banquemoderne");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Requête pour obtenir les notifications de l'utilisateur connecté
$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            max-width: 700px;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .notification-message {
            font-size: 16px;
        }
        .badge-time {
            font-size: 13px;
            background-color: #6c757d;
        }
        .credit {
            font-weight: bold;
            color: #28a745;
        }
        .debit {
            font-weight: bold;
            color: #dc3545;
        }
        .notification-item {
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        .notification-item:hover {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
        }
        .empty-state {
            text-align: center;
            padding: 40px 0;
        }
        .empty-state i {
            font-size: 50px;
            color: #6c757d;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📩 Mes Notifications</h3>
        <a href="moncompte.php" class="btn btn-outline-primary">Retour au tableau de bord</a>
    </div>
    
    <?php if ($result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($row = $result->fetch_assoc()): 
                $msg = htmlspecialchars($row['message']);
                // Appliquer mise en forme
                $msg = str_ireplace("crédité", "<span class='credit'>crédité</span>", $msg);
                $msg = str_ireplace("débité", "<span class='debit'>débité</span>", $msg);
                $msg = str_ireplace("virement", "<strong>virement</strong>", $msg);
                
                // Formater la date
                $date = new DateTime($row['created_at']);
                $formatted_date = $date->format('d/m/Y à H:i');
            ?>
                <div class="list-group-item notification-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="notification-message"><?= $msg ?></span>
                        <span class="badge badge-time"><?= $formatted_date ?></span>
                    </div>
                    <?php if (!empty($row['details'])): ?>
                        <div class="mt-2 text-muted small">
                            <i class="fas fa-info-circle"></i> <?= htmlspecialchars($row['details']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="far fa-bell-slash"></i>
            <h4>Aucune notification</h4>
            <p class="text-muted">Vous n'avez aucune notification pour le moment.</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
$stmt->close();
$conn->close(); 
?>