<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: connex.php');
    exit();
}

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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services Bancaires</title>
    <!-- Bootstrap JS Bundle (inclut Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    /* Style global */
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    position: relative;
    overflow-x: hidden;
}

/* Pseudo-élément pour le fond flou */
body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("tahadi.jpg");
    background-size: cover;
    background-position: center;
    filter: blur(8px); /* Niveau de flou */
    z-index: -1; /* Pour le placer derrière le contenu */
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
.services-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 colonnes */
    gap: 20px; /* espacement entre les cartes */
    padding: 20px;
    justify-items: center; /* centre les cartes horizontalement */
}
/* Carte de service */
.service-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease;
    flex: 1 1 300px;  /* La carte prend au minimum 300px, mais peut s'étirer */
    max-width: 300px;  /* Limite la largeur à 300px */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%; /* Assure que les cartes s'ajustent en hauteur */
}

    .service-card:hover {
      transform: scale(1.05);
      background-color: beige;
    }


/* Pour les petits écrans */
@media (max-width: 768px) {
    .services-container {
        justify-content: flex-start;  /* Change l'alignement pour éviter l'espace inutile sur les petits écrans */
    }

    .service-card {
        flex: 1 1 100%;  /* Les cartes prennent toute la largeur sur les petits écrans */
        max-width: 100%;
    }
}
    .service-card h3 {
      font-size: 1.2rem;
      margin: 10px 0;
    }

    .service-card p {
      font-size: 0.9rem;
      color: #666;
    }
    /* Bouton "Voir plus" */
.service-card .btn {
    margin-top: auto;  /* Le bouton se place en bas */
    padding: 10px 20px;
    background-color:#daddd8;
    color: white;
    border: none;
    border-radius: 8px;
    text-align: center;
    transition: background-color 0.3s;
}

.service-card .btn:hover {
    background-color:orange;
}


    @media (max-width: 768px) {
      .services-container {
        grid-template-columns: 1fr;
      }
    }

/* Wrapper pour centrer tout le contenu */
.wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 40px 20px;
    box-sizing: border-box;
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


        /* Contenu principal */
        .content {
    padding: 50px 30px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            max-width: 1000px;
        }

        .card {
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
    background-color: #E7E7E7;
    color: white;
    border: none;
    padding: 1px 1px;
    border-radius: 5px;
    transition: background 0.3s;
    width: 80%; /* ou 200px si tu veux une taille exacte */
    max-width: 220px;
    margin-top: 15px;
}
.card h4 {
    margin-bottom: 20px;
    font-size: 1.2rem;
}

        .btn-custom:hover {
            background-color: #E7E7E7;
        }

        h1, h3 {
            color: #133215;
            text-align: center;
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


  <!-- Contenu principal -->
  <div class="content" >
    <h1>Les services bancaire BADRLINE </h1>
    <p>Chez BADRLINE , nos services bancaires sont pensés pour vous simplifier la vie, en toute sécurité et avec proximité.</p>
   <div class="services-container">

    <div class="service-card">
   
    <h3>Demande de carte et chéque</h3>
    <p>Demandez votre carte ou chéque en ligne en quelques clics, sans vous déplacer.</p>
    <a href="carte.php" class="btn btn-primary mt-2">Voir plus</a>
    </div>

  
    <div class="service-card">
  
    <h3>Transferts et Virements</h3>
    <p>Envoyez de l’argent rapidement et en toute sécurité, à tout moment.</p>
    <a href="virement.php" class="btn btn-primary mt-2">Voir plus</a>
    </div>

 
    <div class="service-card">
    <h3>Prêts et Crédits</h3>
<p>Simulez, demandez en toute simplicité.</p>
<a href="simulateur.php" class="btn btn-primary mt-2">Voir plus</a>
    </div>


    <div class="service-card">
    <h3>Assurances</h3>
<p>Protégez-vous avec nos offres d’assurance simples et accessibles.</p>

<a href="assurances.php" class="btn btn-primary mt-2">Voir plus</a>
    </div>


    <div class="service-card">
  <h3>Offres Spéciales </h3>
  <p>Bénéficiez de crédits adaptés et d’offres exclusives toute l’année.</p>
  <a href="produit.php" class="btn btn-primary mt-2">Voir plus</a>
</div>


    <div class="service-card">
    <h3>Paiement de Charges</h3>
<p>Réglez vos factures et recharges mobile en toute simplicité.</p>
<a href="paiment.php" class="btn btn-primary mt-2">Voir plus</a>
    </div>
  </div>
</div>

<!-- partie chatbot -->
 <!-- ✅ Partie Chatbot HTML -->
 <div class="chat-tooltip" id="chat-tooltip">
    Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?
</div>

<!-- ✅ Icône flottante -->
<div class="chat-icon" id="chat-icon">
    <img src="icon_chatbot.png" alt="Chat Icon" width="50">
</div>

<!-- ✅ Fenêtre du chatbot -->
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
                <img src="send.png" alt="Envoyer" width="20">
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