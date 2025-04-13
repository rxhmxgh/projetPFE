<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Simulateur des Crédits - Banque El Badr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Bootstrap JS Bundle (inclut Popper.js) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Style personnalisé -->
    <style>
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    position: relative;
    overflow-x: hidden;
}

.background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('background_simu.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(6px); /* ajuste le niveau de flou ici */
    z-index: -7; /* pour que ce soit derrière le contenu */
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


        /* Contenu principal 
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
            display: flex;
    flex-direction: column;
    align-items: center;
            width: 300px;
            background: #ddd;
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

        .card img {
    display: inline-block;
    max-width: 50%;
    height: auto;
}

        .btn-custom {
    background-color: #ffa500;
    border: none;
    padding: 1px 1px;
    border-radius: 5px;
    transition: background 0.3s;
    width: 80%; 
    max-width: 220px;
    margin-top: 15px;
}
.card h4 {
    margin-bottom: 20px;
    font-size: 1.2rem;
}

        .btn-custom:hover {
            background-color: #ff8700;
        }

        h1, h3 {
            color: #133215;
            text-align: center;
        }

*/
/* From Uiverse.io by Thomasfadi */ 
.content {
    padding: 50px 30px;
    min-height: 40vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
}
.text{
    padding: 30px;
    min-height: 10vh;
    text-align: center;
}
.cards {
  display: flex;
  flex-direction: row;
  gap: 40px;
  flex-wrap: wrap;
  justify-content: center;
}
.cards .card {
    height: 300px;
      width: 300px;
      border-radius: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color:black;
      cursor: pointer;
      transition: all 0.4s ease;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}
.card:hover{
    color: orange;
}
.cards .red {
  background-color:rgb(219, 219, 231);
 
}

.cards .blue {
  background-color:rgb(219, 219, 231);
}

.cards .green {
  background-color:rgb(219, 219, 231);
}


.cards .card p.tip {
    font-size: 1.8em;
      font-weight: bold;
      margin-bottom: 15px;
}

.cards .card p.second-text {
  font-size: .7em;
}

.cards .card:hover {
  transform: scale(1.2, 1.2);
}

.cards:hover > .card:not(:hover) {
    filter: blur(5px);
  transform: scale(0.95);
  opacity: 0.7;
}
.btn-custom {
    border: none;
    padding: 1px 1px;
    border-radius: 5px;
    transition: background 0.3s;
    width: 80%; 
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
            <a class="nav-link active" aria-current="page" href="acceuil.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="simulateur.php" onclick="loadPage('simulateur')">Simulation des crédits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="produit.php" onclick="loadPage('produits')">Produits bancaires</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="gere.php">Relever</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historique.php">Historique</a>
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
            <a class="nav-link" href="#">Se déconnecter</a>
          </li>
             
      </div>
    </div>
  </div>
</nav>

    <!-- Contenu principal 
    <div class="content" id="simulateur">
        <h1>Simulateur des Crédits</h1>
        <h3>Crédit Classique</h3>

        <div class="card-container">
            <div class="card">
                <h4>Financement Immobilier</h4>
                <img src="immobilier.png">
             <button class="btn btn-custom mt-2">   <a href="simulation.php" class="btn">Faire une Simulation</a></button>
            </div>
            <div class="card">
                <h4>Crédit Auto</h4>
                <img src="economie.png">
                <button class="btn btn-custom mt-2">   <a href="simulation.php" class="btn">Faire une Simulation</a></button>
                
            </div>
            <div class="card">
                <h4>Crédit Travaux</h4>
                <img src="taux-dinteret.png">
                <button class="btn btn-custom mt-2">   <a href="simulation.php" class="btn">Faire une Simulation</a></button>
            </div>
        </div>
    -->
<!-- background image -->
<div class="background"></div>

<!-- From Uiverse.io by Thomasfadi --> 
<div class="content" id="simulateur">
    <div class="text"></div>
        <h1>Simulateur des Crédits</h1>
        <h3>Crédit Classique</h3>
        <p>Financez vos projets en toute simplicité grâce à notre crédit classique : une solution fiable, rapide et adaptée à votre budget.</p>
        </div>
</div>
<div class="cards">
    <div class="card red">
        <p class="tip">Crédit Immobilier</p>
        <button class="btn btn-custom mt-2">   <a href="simulation.php" class="btn">Faire une Simulation</a></button>
    </div>
    <div class="card blue">
        <p class="tip">Crédit Auto</p>
        <button class="btn btn-custom mt-2">   <a href="simulation.php" class="btn">Faire une Simulation</a></button>
    </div>
    <div class="card green">
        <p class="tip">Crédit Travaux</p>
        <button class="btn btn-custom mt-2">   <a href="simulation.php" class="btn">Faire une Simulation</a></button>
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
    "Quels sont les produits de la banque ?": "Notre banque propose des comptes courants, des comptes épargne, des crédits, des cartes bancaires et bien plus encore.",
    "Comment faire une carte magnétique ?": "Pour obtenir une carte magnétique, rendez-vous en agence avec votre pièce d’identité et un justificatif de compte.",
    "Comment faire pour transférer de l'argent d'un compte à un autre ?": "Vous pouvez effectuer un virement via votre espace en ligne, l’application mobile ou en agence.",
    "Comment faire une carte Visa ?": "Rendez-vous en agence pour demander une carte Visa. Vous devrez fournir des documents et respecter certaines conditions.",
    "Comment payer les factures ?": "Les factures peuvent être payées via votre espace client en ligne, par prélèvement automatique ou directement en agence.",
    "Comment récupérer le code de ma carte ?": "Si vous avez oublié le code de votre carte, demandez un renouvellement du code en agence ou via votre espace client.",
    "Carte perdue : que dois-je faire ?": "En cas de perte, bloquez immédiatement votre carte via l'application ou en contactant le service client, puis demandez une nouvelle carte.",
    "Quelles sont les procédures pour demander un chèque ?": "Pour obtenir un chéquier, faites une demande en agence ou via votre espace client, sous réserve d'éligibilité.",
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
</body>
</html>
