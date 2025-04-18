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

<!-- partie chatbot -->
 <!-- Message d'accueil -->
 <div class="chat-tooltip" id="chat-tooltip">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>

<!-- Icône pour ouvrir/fermer le chatbot -->
<div class="chat-icon" id="chat-icon">
<img src="icon_chatbot.png" alt="Chat Icon" />
</div>

<!-- Chatbot -->
 
<div class="chat-container" id="chat-container">

    <div class="chat-header">Chatbot</div>
    
    <div class="chat-box" id="chat-box">
        <div class="bot-message">Bonjour ! Comment puis-je vous aider ?</div>
    </div>
    <div class="chat-input">
        <select id="question-select">
            <option selected disabled>Choisissez une question...</option>
        </select>
        <button class="send-btn" id="send-btn">➤</button>
    </div>
    <div class="chat-input">
        <input type="text" id="custom-question" placeholder="Posez votre question...">
        <button class="send-btn" id="send-custom-btn" onclick="mailchatbot()">➤</button>
    </div>
</div>

<!-- script d'envoie email -->
<script>
      (function () {
        emailjs.init("UA8naRzna1HefVjV9"); // PUBLIC KEY telkayha f site
      })();

      function mailchatbot() {
        emailjs
          .send("service_0v5y3fp", "template_lhyftlt", { // SERVICE ID w TEMPLATE ID
            to_name: "Bnaque",
            from_name: "Client bancaire",
            message: "Un nouveau message du chatbot !",
            reply_to: "rahmaghomari26@gmail.com",
          })
          .then(
            function (response) {
              alert("Email envoyé avec succès !");
            },
            function (error) {
              console.error("EmailJS Error:", error);
              alert("Erreur lors de l'envoi de l'email: " + JSON.stringify(error));
            }
          );
      }
    </script>



<!-- script de chatbot -->
<script>
    window.onload = function() {
    let tooltip = document.getElementById("chat-tooltip");
    tooltip.style.display = "block";

    // Cacher après 5 secondes
    setTimeout(() => {
        tooltip.style.display = "none";
    }, 5000);
};
// Liste des questions et réponses prédéfinies
const qaData = {
    "Quels sont les produits de la banque ?": "Notre banque propose des comptes courants, des comptes épargne, des crédits, des cartes bancaires et bien plus encore.",
    "Comment faire une carte magnétique ?": "Pour obtenir une carte magnétique, rendez-vous en agence avec votre pièce d’identité et un justificatif de compte.",
    "Comment faire pour transférer de l'argent d'un compte à un autre ?": "Vous pouvez effectuer un virement via votre espace en ligne, l’application mobile ou en agence.",
    "Comment faire une carte Visa ?": "Rendez-vous en agence pour demander une carte Visa. Vous devrez fournir des documents et respecter certaines conditions.",
    "Comment payer les factures ?": "Les factures peuvent être payées via votre espace client en ligne, par prélèvement automatique ou directement en agence.",
    "Comment récupérer le code de ma carte ?": "Si vous avez oublié le code de votre carte, demandez un renouvellement du code en agence ou via votre espace client.",
    "Carte perdue : que dois-je faire ?": "En cas de perte, bloquez immédiatement votre carte via l'application ou en contactant le service client, puis demandez une nouvelle carte.",
    "Quelles sont les procédures pour demander un chèque ou carte ?": "Pour obtenir une carte et un chéquier, 1). Connectez-vous à votre espace personnel. 2).Accédez à Demande de carte et chèque. 3). Remplissez et validez le formulaire.",
    "Comment créer un compte épargne ?": "Rendez-vous en agence avec une pièce d'identité et un justificatif de domicile pour ouvrir un compte épargne.",
    "Quels sont les autres types de comptes et leurs procédures d'ouverture ?": "Nous proposons des comptes courants, épargne et professionnels. Chaque type a des conditions spécifiques, consultez notre site ou une agence."
};


// Ouvrir/Fermer le chatbot
document.getElementById("chat-icon").addEventListener("click", function() {
    console.log("Icône cliquée !");
    let chatContainer = document.getElementById("chat-container");
    chatContainer.style.display = (chatContainer.style.display === "flex") ? "none" : "flex";
   
});

// Générer la liste déroulante avec les questions
function populateQuestions() {
    let select = document.getElementById("question-select");
    for (let question in qaData) {
        let option = document.createElement("option");
        option.value = question;
        option.textContent = question;
        select.appendChild(option);
    }
}

// Envoyer une question et afficher la réponse
document.getElementById("send-btn").addEventListener("click", function() {
    let select = document.getElementById("question-select");
    let question = select.value;
    
    if (question) {
        addUserMessage(question);
        fetchResponse(question);
        select.selectedIndex = 0; // Réinitialiser la sélection
    }
});

// Envoyer une question personnalisée
document.getElementById("send-custom-btn").addEventListener("click", function() {
    let input = document.getElementById("custom-question");
    let question = input.value.trim();
    
    if (question) {
        addUserMessage(question);
        sendEmail(question);
        input.value = "";
    }
});

// Ajouter un message utilisateur
function addUserMessage(message) {
    let chatBox = document.getElementById("chat-box");
    let userMsg = document.createElement("div");
    userMsg.className = "user-message";
    userMsg.textContent = message;
    chatBox.appendChild(userMsg);
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Ajouter un message bot
function addBotMessage(message) {
    let chatBox = document.getElementById("chat-box");
    let botMsg = document.createElement("div");
    botMsg.className = "bot-message";
    botMsg.textContent = message;
    chatBox.appendChild(botMsg);
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Récupérer la réponse en fonction de la question
function fetchResponse(question) {
    let response = qaData[question] || "Désolé, je ne comprends pas votre question.";
    addBotMessage(response);
}

populateQuestions();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
