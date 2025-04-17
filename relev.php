<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: connex.php');
    exit();
}

$host = "localhost";
$dbname = "BanqueModerne";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT nom, prenom, ccp, solde FROM utilisateurs WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Erreur : utilisateur non trouvé.";
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relevé de Compte - Banque Moderne</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Header et Menu */
        .header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #004080;
            color: white;
        }

        .logo img {
            height: 50px;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 12px;
            transition: background 0.3s ease, color 0.3s ease;
            border-radius: 4px;
        }

        .nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffdd57;
        }

        .btn-deconnexion {
            background-color: #dc3545;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-deconnexion:hover {
            background-color: #c82333;
            color: white;
        }

        /* Section Relevé */
        .releve-section {
            text-align: center;
            padding: 50px 20px;
            background-color: white;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .releve-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #004080;
        }

        .releve-info {
            text-align: left;
        }

        fieldset {
            border: 2px solid #004080;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        legend {
            font-weight: bold;
            color: #004080;
            padding: 0 10px;
        }

        .releve-info p {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .btn-virement, .btn-historique {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: 0.3s;
            margin-top: 15px;
        }

        .btn-virement:hover,
        .btn-historique:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #004080;
            color: white;
            margin-top: 50px;
        }

        /* Chatbot */
        #chatbot {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #004080;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        #chatWindow {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            background-color: #ffffff;
            color: black;
            padding: 15px;
            width: 300px;
            height: 400px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        #chatMessages {
            overflow-y: auto;
            height: 300px;
            margin-bottom: 10px;
        }

        #chatInput {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav {
                flex-direction: column;
                width: 100%;
            }

            .nav a,
            .btn-deconnexion {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- Header avec menu -->
    <header class="header">
        <div class="logo">
            <img src="img/logo.webp" alt="Logo Banque Moderne">
        </div>
        <nav class="nav">
            <a href="accueil.php">Accueil</a>
            <a href="bonjour.php">Mon Compte</a>
            <a href="relever.php">Relevé</a>
            <a href="virement.php">Virement</a>
            <a href="rdv.php">Rendez-vous</a>
            <a href="simulateur.php">Simulation Crédit</a>
            <a href="chat.php">Chat</a>
            <a href="logout.php" class="btn-deconnexion">Déconnexion</a>
        </nav>
    </header>

    <!-- Section Relevé -->
    <section class="releve-section">
        <h2>Relevé de Compte</h2>
        <div class="releve-info">
            <fieldset>
                <legend>Informations du Compte</legend>
                <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']); ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']); ?></p>
                <p><strong>Numéro CCP :</strong> <?= htmlspecialchars($user['ccp']); ?></p>
                <p><strong>Solde :</strong> <?= number_format($user['solde'], 2, ',', ' '); ?> DA</p>
            </fieldset>
        </div>
        <a href="virement.php" class="btn-virement">Effectuer un Virement</a>
        <form action="historique.php" method="post" style="margin-top: 15px;">
            <input type="hidden" name="id" value="<?= $_SESSION['user_id']; ?>">
            <button type="submit" class="btn-historique">Voir l'Historique (10 DA)</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Banque Moderne. Tous droits réservés.</p>
    </footer>

    <!-- Chatbot -->
    <div id="chatbot">
        <img src="chat-icon.png" alt="Chat" style="width: 50px; height: 50px;">
    </div>

    <!-- Fenêtre de Chat -->
    <div id="chatWindow">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #004080; padding-bottom: 10px;">
            <h4>Chatbot</h4>
            <button onclick="closeChat()" style="background: none; border: none; color: #004080; font-size: 20px; cursor: pointer;">&times;</button>
        </div>
        <div id="chatMessages">
            <!-- Messages du chat -->
        </div>
        <textarea id="chatInput" placeholder="Tapez votre message..."></textarea>
        <button onclick="sendMessage()" style="background-color: #004080; color: white; padding: 10px; width: 100%; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Envoyer</button>
    </div>

    <script>
        // Fonction pour ouvrir la fenêtre du chat
        document.getElementById('chatbot').onclick = function() {
            document.getElementById('chatWindow').style.display = 'block';
        }

        // Fonction pour fermer la fenêtre du chat
        function closeChat() {
            document.getElementById('chatWindow').style.display = 'none';
        }

        // Fonction pour envoyer un message
        function sendMessage() {
            var message = document.getElementById('chatInput').value;
            if (message.trim() != "") {
                var chatMessages = document.getElementById('chatMessages');
                var userMessage = document.createElement('div');
                userMessage.textContent = "Vous: " + message;
                chatMessages.appendChild(userMessage);
                document.getElementById('chatInput').value = "";

                // Réponse automatique du chatbot
                var botMessage = document.createElement('div');
                botMessage.textContent = "Chatbot: Je suis là pour vous aider!";
                chatMessages.appendChild(botMessage);

                chatMessages.scrollTop = chatMessages.scrollHeight; // Faire défiler jusqu'au bas
            }
        }
    </script>

</body>
</html>
