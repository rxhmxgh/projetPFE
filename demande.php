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
    <title>Demande d'ouvrir un compte bancaire</title>
 <style>
    /* style.css */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
    border-radius: 10px;
    margin-bottom: 30px;
}

h1 {
    text-align: center;
    color: #333;
}

h2 {
    color: #444;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color:rgb(249, 173, 32);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color:rgb(255, 169, 8);
}

textarea {
    height: 100px;
}

input[type="file"] {
    padding: 5px;
}


/* css pour formulaire */
.center-section {
    text-align: center;
    margin: 0 auto;
    padding: 30px;
    max-width: 600px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.download-btn {
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    font-weight: bold;
}

.download-btn:hover {
    background-color: #218838;
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

<div class="container" id="envoyé">
    <h1>Demande d'ouvrir un compte bancaire</h1>
    <p>Remplissez le formulaire ci-dessous pour soumettre votre demande.</p>

    <form action="demande.php" method="POST" enctype="multipart/form-data">
        
        <!-- Informations personnelles -->
        <h2>Informations Personnelles</h2>
        <label for="full_name">Nom complet :</label>
        <input type="text" id="full_name" name="full_name" required>
        
        <label for="dob">Date de naissance :</label>
        <input type="date" id="dob" name="dob" required>
        
        <label for="phone">Numéro de téléphone :</label>
        <input type="tel" id="phone" name="phone" required>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="address">Adresse :</label>
        <textarea id="address" name="address" required></textarea>



        <!-- Tpe de compte -->
        <h2>Type de compte</h2>
        <label for="job_status">Type à choisir:</label>
        <select id="job_status" name="job_status" required>
            <option value="salarié">Compte Courant</option>
            <option value="indépendant">Compte d'Épargne</option>
            <option value="retraité">Compte Joint</option>
        </select>


        <!-- Documents à fournir -->
        <h2>Documents à Fournir</h2>
        <label for="identity_proof">Pièce d'identité :</label>
        <input type="file" id="identity_proof" name="identity_proof" required>

        <label for="income_proof">Extrer de naissance :</label>
        <input type="file" id="income_proof" name="income_proof" required>

        <label for="address_proof">La récidence :</label>
        <input type="file" id="address_proof" name="address_proof" required>

        <!-- Consentement et Soumission -->
        <h2>Consentement</h2>
        <label>
            <input type="checkbox" name="consent" required>
            J'accepte que mes informations soient utilisées conformément à la politique de confidentialité de la banque.
        </label>
        
        <button type="submit">Envoyer ma demande</button>
    </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function () {
      alert("✅ Votre demande est en cours d’envoi. Merci !");
    });
  });
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $full_name = $_POST['full_name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $job_status = $_POST['job_status'] ?? '';
    $consent = isset($_POST['consent']) ? 1 : 0;

    // Fichiers
    $identity_proof = $_FILES['identity_proof'] ?? null;
    $extrait_proof = $_FILES['income_proof'] ?? null;
    $residence_proof = $_FILES['address_proof'] ?? null;
// Sauvegarde dans la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO demandes_compte 
        (full_name, dob, phone, email, address, job_status, identity_file, extrait_file, residence_file, consentement) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $full_name,
        $dob,
        $phone,
        $email,
        $address,
        $job_status,
        $identity_proof['name'] ?? '',
        $extrait_proof['name'] ?? '',
        $residence_proof['name'] ?? '',
        $consent
    ]);

    echo "<br>✅ Les données ont été enregistrées avec succès dans la base.";
} catch (PDOException $e) {
    echo "❌ Erreur de base de données : " . $e->getMessage();
}
}
?>

<!-- telecharger document -->
<div class="center-section">
    <h2>Télécharger le Formulaire PDF</h2>
    <p>Veuillez télécharger, remplir, puis joindre ce formulaire à votre demande si nécessaire :</p>
    
    <a href="formaulaire.pdf" download class="download-btn">📄 Télécharger le formulaire</a>

   
</div>

<!-- partie php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs sont remplis
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $loan_amount = $_POST['loan_amount'];
    $loan_duration = $_POST['loan_duration'];
    $loan_type = $_POST['loan_type'];
    $loan_purpose = $_POST['loan_purpose'];
    $job_status = $_POST['job_status'];
    $monthly_income = $_POST['monthly_income'];
    $monthly_expense = $_POST['monthly_expense'];
    
    // Traitement des fichiers téléchargés
    $identity_proof = $_FILES['identity_proof'];
    $Extrer_proof = $_FILES['income_proof'];
    $récidence_proof = $_FILES['address_proof'];

    // Vérifier que l'utilisateur a accepté les termes
    if (isset($_POST['consent'])) {
        // Vérification des fichiers téléchargés
        $target_dir = "uploads/"; // Répertoire où les fichiers seront stockés

        // Créer le répertoire si nécessaire
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Fonction pour gérer le téléchargement des fichiers
        function handleFileUpload($file, $target_dir) {
            $target_file = $target_dir . basename($file["name"]);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Vérifier la taille du fichier
            if ($file["size"] > 5000000) { // Limiter à 5MB
                return "Le fichier est trop volumineux.";
            }

            // Vérifier le type de fichier (ici, on accepte les images et les PDF)
            if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "pdf") {
                return "Seuls les fichiers JPG, JPEG, PNG et PDF sont autorisés.";
            }

            // Télécharger le fichier
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return "Le fichier " . htmlspecialchars(basename($file["name"])) . " a été téléchargé avec succès.";
            } else {
                return "Erreur lors du téléchargement du fichier.";
            }
        }

        // Télécharger les documents
        $identity_msg = handleFileUpload($identity_proof, $target_dir);
        $Exter_msg = handleFileUpload($Extrer_proof, $target_dir);
        $récidence_msg = handleFileUpload($récidence_proof, $target_dir);

        echo "Votre demande a été soumise avec succès. Voici les résultats des fichiers téléchargés :<br>";
        echo "Pièce d'identité : $identity_msg<br>";
        echo "Extrer de naissance : $Extrer_msg<br>";
        echo "La récidence: $récidence_msg<br>";

        // Vous pouvez également enregistrer ces informations dans une base de données ici
    } else {
        echo "Vous devez accepter les termes et conditions pour soumettre votre demande.";
    }
} else {
    echo "Aucune donnée soumise.";
}
?>



























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

</body>
</html>
