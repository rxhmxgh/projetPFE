<?php // Démarrer la session
session_start();

// Connexion à la base de données (PDO pour toutes les opérations)
$host = "localhost";
$dbname = "banquemoderne";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion PDO : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connex.php');
    exit();
}

// Récupérer le CCP de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT ccp FROM utilisateurs WHERE id = :id");
$stmt->execute(["id" => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$ccpSource = $user ? $user["ccp"] : "";

// Traitement du formulaire de virement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["virement"])) {
    $ccpDest = htmlspecialchars($_POST["ccp_dest"]);
    $montant = floatval($_POST["montant"]);

    if ($montant > 0) {
        try {
            $pdo->beginTransaction();

            // Vérifier l'existence des comptes
            $stmtSrc = $pdo->prepare("SELECT id, solde FROM utilisateurs WHERE ccp = :ccp");
            $stmtSrc->execute(["ccp" => $ccpSource]);
            $source = $stmtSrc->fetch(PDO::FETCH_ASSOC);

            $stmtDest = $pdo->prepare("SELECT id, solde FROM utilisateurs WHERE ccp = :ccp");
            $stmtDest->execute(["ccp" => $ccpDest]);
            $dest = $stmtDest->fetch(PDO::FETCH_ASSOC);

            if ($source && $dest) {
                if ($source["solde"] >= $montant) {
                    // Effectuer le virement
                    $updateSrc = $pdo->prepare("UPDATE utilisateurs SET solde = solde - :montant WHERE id = :id");
                    $updateSrc->execute(["montant" => $montant, "id" => $source["id"]]);

                    $updateDest = $pdo->prepare("UPDATE utilisateurs SET solde = solde + :montant WHERE id = :id");
                    $updateDest->execute(["montant" => $montant, "id" => $dest["id"]]);

                    // Enregistrer les transactions
                    $transactionStmt = $pdo->prepare("INSERT INTO transactions (utilisateur_id, type, montant) VALUES (:utilisateur_id, 'virement_envoye', :montant)");
                    $transactionStmt->execute(["utilisateur_id" => $source["id"], "montant" => $montant]);

                    $transactionStmt = $pdo->prepare("INSERT INTO transactions (utilisateur_id, type, montant) VALUES (:utilisateur_id, 'virement_recu', :montant)");
                    $transactionStmt->execute(["utilisateur_id" => $dest["id"], "montant" => $montant]);

                    $pdo->commit();
                    echo "✅ Virement effectué avec succès.";
                } else {
                    echo "❌ Solde insuffisant.";
                }
            } else {
                echo "❌ Numéro CCP introuvable.";
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "❌ Erreur de virement : " . $e->getMessage();
        }
    } else {
        echo "⚠️ Le montant doit être supérieur à zéro.";
    }
}


// Traitement de la question utilisateur (chatbot)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_question'])) {
    $question = htmlspecialchars($_POST['user_question']);
    $stmt = $pdo->prepare("INSERT INTO questions (user_question) VALUES (:question)");
    $stmt->execute(["question" => $question]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Récupération des questions et réponses
$questionsStmt = $pdo->query("SELECT user_question, admin_response FROM questions ORDER BY created_at ASC");
$questions = $questionsStmt->fetchAll(PDO::FETCH_ASSOC);


?>

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
    <title>Virement - Banque Moderne</title>
  <style>
    /* Styles généraux */
    body {
  background: linear-gradient(145deg, #e0e0e0,rgb(245, 245, 245));
  min-height: 100vh;
  padding: 40px 0;
  font-family: 'Poppins', sans-serif;
}
.content {
            background-color: rgba(255, 248, 248, 0.46);;
    padding: 50px 20px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
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
            background-color: #E7E7E7;
            border: none;
        }
        .btn-primary:hover {
            background-color: #E7E7E7;

        }
        .btn-clicked {
            
            color: white;
        }
        .row {
            margin-top: 30px;
        }

/* Conteneur principal pour centrer */
.transfer-section {
    background: white;
    padding: 40px 30px;
    border-radius: 25px;
    box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    margin: 0 auto; /* ⬅️ CENTRAGE HORIZONTAL */
    text-align: center;
}

/* Les champs et labels */
label {
    display: block;
    text-align: left;
    font-weight: bold;
    margin: 10px 0 5px;
    color: #555;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 8px; 
    font-size: 16px;
}

input[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
}

/* Boutons */
.btn-transfer {
    width: 100%;
    background-color:rgba(170, 239, 170, 0.68);
    color: black;
    border: none;
    padding: 12px;
    font-size: 18px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.btn-transfer:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    background-color:rgba(170, 239, 170, 0.68);
}

.btn-back {
    display: inline-block;
    margin-top: 15px;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.btn-back:hover {
    transform: translateY(-2px);
    background-color: #0056b3;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}


/* partie de chatbot  */
/* Icône flottante et message d'accueil */
.chat-tooltip {
    position: fixed; 
    bottom: 90px;
    right: 90px;
    background: #333;
    color: #fff;
    padding: 12px 20px;
    border-radius: 20px;
    font-size: 14px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    z-index: 999;
    animation: fadeIn 0.5s;
}

.chat-tooltip::after {
    content: "";
    position: absolute;
    bottom: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-width: 6px;
    border-style: solid;
    border-color: #333 transparent transparent transparent;
}

.chat-icon {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #4CAF50;
    border-radius: 50%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 999;
    transition: transform 0.2s;
}
.chat-icon:hover {
    transform: scale(1.1);
}
.chat-icon img {
    width: 30px;
    height: 30px;
}

/* Fenêtre du chatbot */
.chatbot-container {
    width: 400px;
    background: #d4e9d3;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    display: none;
    position: fixed;
    bottom: 100px;
    right: 30px;
    z-index: 1000;
    flex-direction: column;
    min-width: 300px;
    max-width: 400px;
    width: 100%;
}

/* En-tête */
.chat-header {
    background: #43a047;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
}

/* Zone de discussion */
.chat-body {
    background: white;
    padding: 15px;
    height: 300px;
    overflow-y: scroll;
    display: flex;
    flex-direction: column;
}
.message {
    margin: 10px 0;
    padding: 10px 15px;
    border-radius: 20px;
    max-width: 80%;
    word-wrap: break-word !important;
}
.from-user {
    background: #e0e0e0;
    align-self: flex-start !important;
}
.from-admin {
    background: #c8e6c9;
    align-self: flex-end;
    text-align: right  !important;
}

/* Pied du chatbot */
.chat-footer {
    background: #d9e8d9;
    padding: 10px;
}
.form-section {
    display: flex;
    gap: 5px;
    margin-bottom: 10px;
    
}
select, input[type="text"] {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
}
select {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.btn-send {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: #4CAF50;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.btn-send img {
    width: 20px;
    height: 20px;
}
.form-section {
    display: flex;
    gap: 5px;
    margin-bottom: 10px;
    align-items: center;
    flex-wrap: nowrap;
}
select, input[type="text"] {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    max-width: 90%; /* ne pas dépasser la largeur du conteneur */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
  </style>
</head>
<body>
    
 <!-- partie menu  -->
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">BADR LINE</a>
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
            <a class="nav-link active" aria-current="page" href="acceuil.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="simulateur.php" onclick="loadPage('simulateur')">Simulation des crédits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="produit.php" onclick="loadPage('produits')">Produits bancaires</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rendezvous.php" onclick="loadPage('rendez-vous')">Rendez-Vous</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="relev.php">Relever</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.php">Les services bancaire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="map.php" onclick="loadPage('map')">Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="moncompte.php" onclick="loadPage('compte')">Mon compte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Se déconnecter</a>
          </li>
             
      </div>
    </div>
  </div>
</nav>

<div class="content" style="background: linear-gradient(145deg, #e0e0e0, #f5f5f5); min-height: 100vh; padding: 50px 0;">
  <div class="container mt-5">
    <h2 class="text-center mb-5 text-dark fw-bold">
    Effecturer un virement
    </h2>
    <section class="transfer-section">
      
        <form method="post" action="">
            <label>Numéro CCP Source :</label>
            <input type="text" name="ccp_source" value="<?= htmlspecialchars($ccpSource); ?>" readonly>

            <label>Numéro CCP Destinataire :</label>
            <input type="text" name="ccp_dest" required>

            <label>Montant :</label>
            <input type="number" name="montant" step="1" required>

            <button type="submit" name="virement" class="btn-transfer">Effectuer le Virement</button>
        </form>

        <!-- Bouton pour retourner au relevé de compte -->
        <a href="relev.php" class="btn-back">🔙 Retour au Relevé de Compte</a>
    </section>
  



<!-- partie chatbot -->
 <!-- Message d'accueil -->
 <div class="chat-tooltip" id="chat-tooltip">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>

<!-- Icône pour ouvrir/fermer le chatbot -->
<div class="chat-icon" id="chat-icon">
<img src="icon_chatbot.png" alt="Chat Icon" />
</div>

<!-- Chatbot -->
 <!-- ✅ Fenêtre du chatbot -->
<div class="chatbot-container" id="chat-container">
    <div class="chat-header">Chatbot</div>
    <div class="chat-body" id="chat">
    <div class="message from-user">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>
 <?php
    if (!empty($questions)) {
        foreach ($questions as $row) {
            echo '<div class="message from-user">' . htmlspecialchars($row['user_question']) . '</div>';
            if (!empty($row['admin_response'])) {
                echo '<div class="message from-admin">' . htmlspecialchars($row['admin_response']) . '</div>';
            }
        }
    }
    ?>
</div>

<script>
  document.getElementById("send-custom-btn").addEventListener("click", function() {
    let message = document.getElementById("fixed-message").textContent.trim();
    addUserMessage(message);
    sendEmail(message);
  });
</script>

<div class="chat-footer">
        <!-- Choix rapide -->
        <form class="form-section" onsubmit="return false;">
            <select onchange="faqSelected(this)" id="faq">
                <option value="">Choisissez une question...</option>
                <option value="Quels sont les produits de la banque ?">Quels sont les produits de la banque ?</option>
                <option value="Comment faire une carte magnétique ?">Comment faire une carte magnétique ?</option>
                <option value="Comment faire pour transférer de l'argent d'un compte à un autre ?">Comment faire pour transférer de l'argent d'un compte à un autre ?</option>
                <option value="Comment faire une carte Visa ?">Comment faire une carte Visa ?</option>
                <option value="Comment payer les factures ?">Comment payer les factures ?</option>
                <option value="Comment récupérer le code de ma carte ?">Comment récupérer le code de ma carte ?</option>
                <option value="Carte perdue : que dois-je faire ?">Carte perdue : que dois-je faire ?</option>
                <option value="Quelles sont les procédures pour demander un chèque ou carte ?">Quelles sont les procédures pour demander un chèque ou carte ?</option>
                <option value="Comment créer un compte épargne ?">Comment créer un compte épargne ?</option>
                <option value="Quels sont les autres types de comptes et leurs procédures d'ouverture ?">Quels sont les autres types de comptes et leurs procédures d'ouverture ?</option>
               
            </select>
            <button type="button" class="btn-send" onclick="sendFAQ()">
                <img src="send.png"  alt="Envoyer" width="20">
            </button>
        </form>

        <p style="font-size: 12px; color: #333; margin: 5px;">Vous pouvez poser vos questions directement 👇</p>

        <!-- Envoi de question -->
        <form class="form-section" id="manual-question-form" method="POST" action="">

            <input type="text" name="user_question" placeholder="Votre question..." required>
            <button type="submit" class="btn-send">
                <img src="send.png" alt="Envoyer" width="20">
            </button>
        </form>
    </div>
</div>

<!-- ✅ Script JavaScript -->
<script>
    // ✅ Masquer le message d’accueil après 5s
    setTimeout(() => {
        document.getElementById("chat-tooltip").style.display = "none";
    }, 5000);

    // ✅ Ouvrir/fermer le chatbot
    document.getElementById("chat-icon").addEventListener("click", function () {
        const chatContainer = document.getElementById("chat-container");
        chatContainer.style.display = (chatContainer.style.display === "flex" || chatContainer.style.display === "block") ? "none" : "flex";
        chatContainer.style.flexDirection = "column";
    });
    // ✅ Liste de questions/réponses prédéfinies
    const qaData = {
       "Quels sont les produits de la banque ?": "Notre banque propose des comptes courants, des comptes épargne, des crédits, des cartes bancaires et bien plus encore, pour plus de déttails consultez notre site.",
    "Comment faire une carte magnétique ?": "Pour obtenir une carte magnétique, accéder au services bancaire sur notre sites pour savoir plus.",
    "Comment faire pour transférer de l'argent d'un compte à un autre ?": "Vous pouvez effectuer un virement via votre espace en ligne, sur notre site en ligne ou en agence.",
    "Comment faire une carte Visa ?": "Rendez-vous en agence pour demander une carte Visa. Vous devrez fournir des documents et respecter certaines conditions.",
    "Comment payer les factures ?": "Les factures peuvent être payées via votre espace client en ligne, par prélèvement automatique ou directement en agence.",
    "Comment récupérer le code de ma carte ?": "Si vous avez oublié le code de votre carte, demandez un renouvellement du code en agence ou conctacteznotre service.",
    "Carte perdue : que dois-je faire ?": "En cas de perte, bloquez immédiatement votre carte via l'application ou en contactant le service client, puis demandez une nouvelle carte.",
    "Quelles sont les procédures pour demander un chèque ou carte ?": "Pour obtenir une carte et un chéquier, 1). Connectez-vous à votre espace personnel. 2).Accédez à Demande de carte et chèque. 3). Remplissez et validez le formulaire.",
    "Comment créer un compte épargne ?": "Rendez-vous en agence avec une pièce d'identité et un justificatif de domicile pour ouvrir un compte épargne.",
    "Quels sont les autres types de comptes et leurs procédures d'ouverture ?": "Nous proposons des comptes courants, épargne et professionnels. Chaque type a des conditions spécifiques, consultez notre site ou une agence."
    };

    const chat = document.getElementById("chat");

    // ✅ Ajouter un message dans la discussion
    function appendMessage(content, sender = "user") {
        const div = document.createElement("div");
        div.className = "message from-" + sender;
        div.textContent = content;
        chat.appendChild(div);
        chat.scrollTop = chat.scrollHeight;
    }

    // ✅ Lorsqu'on choisit une question dans le menu
    function faqSelected(select) {
        const question = select.value;
        if (question) {
            document.querySelector('input[name="user_question"]').value = question;
        }
    }

    // ✅ Lorsqu'on clique sur le bouton d'envoi du menu déroulant
    function sendFAQ() {
        const question = document.getElementById("faq").value;
        if (question) {
            appendMessage(question, "user");

            const response = qaData[question];
            if (response) {
                setTimeout(() => appendMessage(response, "admin"), 600);
            } else {
                setTimeout(() => appendMessage("Un conseiller vous répondra sous peu.", "admin"), 600);
            }

            document.getElementById("faq").value = "";
            document.querySelector('input[name="user_question"]').value = "";
        }
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
