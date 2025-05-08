<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: seconnecter.php');
    exit();
}
?>
<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "banquemoderne";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_question'])) {
    $question = $conn->real_escape_string($_POST['user_question']);
    $conn->query("INSERT INTO questions (user_question) VALUES ('$question')");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Récupération des questions et réponses
$questions = $conn->query("SELECT user_question, admin_response FROM questions ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement - Banque Moderne</title>
     <!-- Bootstrap JS Bundle (inclut Popper.js) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  

    <style>
        /* Reset de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    position: relative;
    overflow-x: hidden;
    background: linear-gradient(135deg, #eef2f3, #d9dde0);
}

.content {
    padding: 50px 30px;
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
/* Main Content */
.container {
    flex: 1;
    padding: 40px 20px;
    max-width: 1100px;
    margin: auto;
}

h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.2rem;
    color:rgb(13, 14, 13);
}

.paiement-section {
    background: white;
    padding: 70px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

.paiement-section h3 {
    margin-bottom: 20px;
    color:rgb(36, 67, 88);
}

/* Formulaires */
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    font-weight: 50;
    display: flex;
    flex-direction: column;
    font-size: 1rem;
}

input[type="text"],
input[type="number"],
select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    width: 100%;
    margin-top: 5px;
}

button[type="submit"] {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 20px; /* plus petit */
    border-radius: 20px;
    font-size: 0.9rem; /* taille de texte réduite */
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
    width: fit-content; /* évite de prendre toute la largeur */
    align-self: flex-start; /* bouton à gauche du formulaire */
}

button[type="submit"]:hover {
    background-color: #218838;
}

/* Responsive */
@media (max-width: 768px) {
    .nav {
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    .container {
        padding: 20px 15px;
    }

    h2 {
        font-size: 1.8rem;
    }
}

@media (max-width: 480px) {
    .header {
        padding: 10px;
    }

    .logo img {
        height: 40px;
    }

    h2 {
        font-size: 1.6rem;
    }

    .paiement-section {
        padding: 20px;
    }

    button[type="submit"] {
        padding: 10px;
        font-size: 0.9rem;
    }
}


.bloc-gauche {
  flex: 1;
  min-width: 300px;
}

.titre-avec-trait {
  font-family: Arial, sans-serif;
  font-size: 24px;
  color:rgb(27, 83, 10);
  margin: 0;
}

.trait-horizontal {
  height: 4px;
  background-color:rgb(231, 171, 42);
  width: 100%;
  margin-top: 10px;
  border-radius: 2px;
}
.contenu {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 70px 60px;
  flex-wrap: wrap;
  gap: 40px;
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
    word-wrap: break-word;
}
.from-user {
    background: #e0e0e0;
    align-self: flex-start;
}
.from-admin {
    background: #c8e6c9;
    align-self: flex-end;
    text-align: right;
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
/* Bouton rond avec icône pour envoi */
.input-group {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}

.input-group input[type="text"],
.input-group select {
    flex: 1;
    padding: 8px 12px;
    border-radius: 20px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.btn-send-icon {
    width: 36px;
    height: 36px;
    background-color: #4CAF50;
    border: none;
    border-radius: 50%;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.btn-send-icon img {
    width: 16px;
    height: 16px;
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

<div class="content" >
<div class="content" >
<div class="bloc-gauche">
     <h2 class="titre-avec-trait"> Services de Paiement</h2>
     <div class="trait-horizontal"></div>
     </div>
<main class="container">
 

    <!-- Recharge Mobile -->
    <section class="paiement-section">
    <h3>
    <img src="rechargemobile.png" alt="Icône Téléphone" style="width:30px; height:30px; vertical-align:middle; margin-right:8px;">
    Recharge Mobile
</h3>
<form action="traitement_recharge.php" method="post" onsubmit="return validateForm();">
        <label for="operateur">Opérateur :</label>
        <select name="operateur" id="operateur" required>
            <option value="">-- Choisir --</option>
            <option value="Ooredoo">Ooredoo</option>
            <option value="Djezzy">Djezzy</option>
            <option value="Mobilis">Mobilis</option>
        </select>

        <label for="numero">Numéro de téléphone :</label>
        <input type="text" name="numero" id="numero" maxlength="10" placeholder="Ex: 0771234567" required>

        <label for="montant">Montant (DA) :</label>
        <input type="number" name="montant" id="montant" min="50" step="10" required>

        <div id="erreur" class="error"></div>

        <button type="submit">Valider la Recharge</button>
    </form>
    </section>
    <script>
        function validateForm() {
            const operateur = document.getElementById("operateur").value;
            const numero = document.getElementById("numero").value.trim();
            const erreur = document.getElementById("erreur");

            let regex;

            if (operateur === "Ooredoo") {
                regex = /^05\d{8}$/;
            } else if (operateur === "Mobilis") {
                regex = /^06\d{8}$/;
            } else if (operateur === "Djezzy") {
                regex = /^07\d{8}$/;
            }

            if (!regex.test(numero)) {
                erreur.textContent = "Le numéro doit commencer par " + regex.source.slice(1, 3) + " et comporter 10 chiffres.";
                return false;
            }

            erreur.textContent = "";
            return true;
        }
    </script>

    <!-- Internet & Facture Téléphonique -->
    <section class="paiement-section">
        <h3> 
        <img src="rechargeinternet.png" alt="Icône Téléphone" style="width:30px; height:30px; vertical-align:middle; margin-right:8px;">
            Internet & Téléphonie - Algérie Télécom</h3>
        <form action="traitement_internet.php" method="post">
            <label>Service :
                <select name="type_service" required>
                    <option value="recharge_internet">Recharge Internet</option>
                    <option value="facture_telephone">Facture Téléphonique</option>
                </select>
            </label>

            <label>Identifiant / N° Téléphonique :
                <input type="text" name="identifiant" required>
            </label>

            <label>Montant (DA) :
                <input type="number" name="montant" min="100" required>
            </label>

            <button type="submit">Payer</button>
        </form>
    </section>

    <!-- Facture ADE -->
    <section class="paiement-section">
        <h3> 
        <img src="ade.png" alt="Icône Téléphone" style="width:80px; height:80px; vertical-align:middle; margin-right:8px;">    
        Paiement Facture ADE</h3>
        <form action="traitement_ade.php" method="post">
            <label>Référence de la facture :
                <input type="text" name="reference_facture" required>
            </label>

            <label>Montant (DA) :
                <input type="number" name="montant" min="100" required>
            </label>

            <button type="submit">Payer</button>
        </form>
    </section>
</main>

</div>
</div>


<!-- partie chatbot -->
<!-- Message d'accueil -->
<!-- Message d'accueil -->
<div class="chat-tooltip" id="chat-tooltip">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>

<!-- Icône pour ouvrir/fermer le chatbot -->
<div class="chat-icon" id="chat-icon">
    <img src="icon_chatbot.png" alt="Chat Icon" />
</div>

<!-- Chatbot -->
<div class="chatbot-container" id="chat-container">
    <div class="chat-header">Chatbot</div>

    <div class="chat-body" id="chat">
        <div class="message from-user">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>
        <?php
        if (isset($questions)) {
            while ($row = $questions->fetch_assoc()) {
                echo '<div class="message from-user">' . htmlspecialchars($row['user_question']) . '</div>';
                if (!empty($row['admin_response'])) {
                    echo '<div class="message from-admin">' . htmlspecialchars($row['admin_response']) . '</div>';
                }
            }
        }
        ?>
    </div>

    <div class="chat-footer">
        <!-- Choix rapide -->
        <form class="form-section" onsubmit="return false;">
            <div class="input-group">
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
                <button type="button" class="btn-send-icon" onclick="sendFAQ()">
                    <img src="send.png" alt="Envoyer" width="20">
                </button>
            </div>
        </form>

        <p style="font-size: 12px; color: #333; margin: 5px;">Vous pouvez poser vos questions directement 👇</p>

        <!-- Envoi de question libre -->
        <form class="form-section" id="manual-question-form" method="POST" action="">
            <div class="input-group">
                <input type="text" name="user_question" placeholder="Votre question..." required>
                <button type="submit" class="btn-send-icon">
                    <img src="send.png" alt="Envoyer" width="20">
                </button>
            </div>
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
