<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Simulation Crédit à la Consommation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
     body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    position: relative;
    overflow-x: hidden;
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
<div class="container my-5">
  <h2 class="text-center mb-4">SIMULATION CRÉDIT À LA CONSOMMATION</h2>

  <form onsubmit="event.preventDefault(); calculer();" class="row g-3">
    <div class="col-md-6">
      <label for="age" class="form-label">Âge du souscripteur: <span id="ageValue">30</span> ans</label>
      <input type="range" class="form-range" id="age" min="18" max="100" value="30" oninput="document.getElementById('ageValue').innerText = this.value">
    </div>

    <div class="col-md-6">
      <label for="duree" class="form-label">Durée: <span id="dureeValue">12</span> mois</label>
      <input type="range" class="form-range" id="duree" min="6" max="120" value="12" oninput="dureeValue.innerText = this.value">
    </div>

    <div class="col-md-6">
      <label for="revenu" class="form-label">Revenu Mensuel Global (DA)</label>
      <input type="number" class="form-control" id="revenu" value="250000" required>
    </div>

    <div class="col-md-6">
      <label for="cout" class="form-label">Coût du bien (DA)</label>
      <input type="number" class="form-control" id="cout" value="350000" required>
    </div>

    <div class="col-md-6">
      <label for="montantCredit" class="form-label">Montant souhaité en crédit (DA)</label>
      <input type="number" class="form-control" id="montantCredit" value="200000" required>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="codebiteur">
        <label class="form-check-label" for="codebiteur">Co-débiteur</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="clients">
        <label class="form-check-label" for="clients">Clients - Entreprises conventionnées</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="personnel">
        <label class="form-check-label" for="personnel">Personnel BADR/autres banques</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="apport">
        <label class="form-check-label" for="apport">Apport personnel</label>
      </div>
    </div>

    <div class="col-md-6">
      <label for="type" class="form-label">Type de crédit</label>
      <select class="form-select" id="type">
        <option>Véhicules particuliers de tourisme</option>
        <option>Électroménager</option>
        <option>Travaux domestiques</option>
      </select>
    </div>

    <div class="col-12 text-center mt-4">
      <button type="submit" class="btn btn-success me-2">Calculer</button>
      <button type="button" onclick="window.print()" class="btn btn-secondary">Imprimer</button>
    </div>
  </form>

  <div class="alert alert-info text-center mt-4" id="resultat">
    Résultat de la simulation
  </div>
</div>

<script>
  function calculer() {
    const revenu = parseFloat(document.getElementById("revenu").value);
    const cout = parseFloat(document.getElementById("cout").value);
    const montantCredit = parseFloat(document.getElementById("montantCredit").value);
    const age = parseInt(document.getElementById("age").value);
    const duree = parseInt(document.getElementById("duree").value);

    const tauxInteretBase = 0.05; // 5% d'intérêt de base
    let tauxInteret = tauxInteretBase; // Par défaut, taux à 5%
    let periode = duree; // Période par défaut (60 mois)
    periode = 48;
    if (age > 80 && duree > 48) {
  document.getElementById("resultat").innerText = "Pour un souscripteur de plus de 80 ans, la durée maximale est limitée à 48 mois.";
  return;
}

    // Validation de la condition de revenu : ici, on suppose qu'il faut que le revenu soit supérieur à un certain seuil
    if (revenu < 20000){
      document.getElementById("resultat").innerText = "Le revenu mensuel est insuffisant pour accorder un crédit.";
      return;
    }

    if (montantCredit > cout) {
  document.getElementById("resultat").innerText = "Le montant du crédit ne peut pas dépasser le coût du bien.";
  return;
}

    // Si le client a un co-débiteur, réduire l'intérêt
    if (document.getElementById("codebiteur").checked) {
      tauxInteret -= 0.02; // Réduction de 2% sur le taux d'intérêt
    }

    // Si le client est un employé d'une entreprise conventionnée, on réduit également l'intérêt
    if (document.getElementById("clients").checked) {
      tauxInteret -= 0.01; // Réduction de 1% sur le taux d'intérêt
    }

    // Apport personnel pourrait également réduire le taux d'intérêt
    if (document.getElementById("apport").checked) {
      tauxInteret -= 0.02; // Réduction de 2% sur le taux d'intérêt
    }

    // Calcul de la mensualité selon la formule donnée
    const mensualite = (montantCredit * tauxInteret) / (1 - Math.pow(1 + tauxInteret, -periode));

    document.getElementById("resultat").innerText =
      `Montant mensuel estimé : ${mensualite} DA (pour un crédit de ${montantCredit} DA, taux ${tauxInteret * 100}%, durée de ${periode} mois).`;
  }
</script>




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
