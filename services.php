<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: seconnecter.php');
    exit();
}
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
/* partie de chatbot  */
       /* Icône du chatbot */
      /* Style du message */
      .chat-tooltip {
    position: fixed;
    bottom: 80px; /* Position au-dessus de l'icône */
    right: 20px;
    background-color: #4a4a4a;
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 14px;
    white-space: nowrap;
    display: none; /* Caché par défaut */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 101;
}
/* Ajoute une petite flèche en dessous du message */
.chat-tooltip::after {
    content: "";
    position: absolute;
    bottom: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-width: 6px;
    border-style: solid;
    border-color: #4a4a4a transparent transparent transparent;
}

       .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ff9800;
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px;
            z-index: 100;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .chat-icon img {
    width: 50px; /* Ajuste la taille selon ton besoin */
    height: 50px;
    border-radius: 50%; /* Pour garder un effet arrondi */
    cursor: pointer;

}

        /* Conteneur du chatbot */
        .chat-container {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            background: white;
            border-radius:20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: none;
            flex-direction: column;
        }
        /* En-tête du chatbot */
        .chat-header {
            background:#4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        /* Zone des messages */
        .chat-box {
            height: 300px;
            overflow-y: auto;
            padding: 10px;
            background: #fff;
        }
        /* Messages bot et utilisateur */
        .bot-message, .user-message {
            padding: 8px;
            margin: 5px;
            border-radius: 0px 30px;
            max-width: 80%;
        }
        .bot-message {
            background: #ddd;
            text-align: left;
        }
        .user-message {
            background:rgb(147, 209, 179);
    text-align: left;
    padding: 10px 15px;
    margin: 5px;
    border-radius: 0px 30px;
    max-width: 80%;
    word-wrap: break-word; /* Permet de couper les mots longs */
    white-space: normal; /* Permet aux textes longs de passer à la ligne */
        }
        /* Barre de saisie et sélection */
        .chat-input {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #eee;
            border-top: 1px solid #ccc; /* Ajoute une séparation */
            gap: 5px; /* Ajout d'un espacement entre les éléments */
        }
        /* Liste déroulante */
        select {
        
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            max-width: calc(100% - 50px); /* Empêche la liste de prendre trop d'espace */
            overflow: hidden;
            text-overflow: ellipsis; /* Ajoute "..." si le texte est trop long */
            white-space: nowrap; /* Empêche le retour à la ligne */
        }
        /* Bouton d'envoi */
        .send-btn {
            background: green;
            color: white;
            border: none;
            padding: 8px 12px;
            margin-left: 5px;
            cursor: pointer;
            border-radius: 5px;
            min-width: 40px; /* Force un minimum pour qu'il soit visible */
            flex-shrink: 0; /* Empêche le bouton d'être écrasé */
            justify-content: center;
            align-items: center;
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