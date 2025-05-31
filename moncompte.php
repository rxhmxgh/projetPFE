<?php
session_start();

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connex.php');
    exit();
}



// Connexion à la base via PDO (pour récupérer l'utilisateur)
try {
    $pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Erreur : utilisateur non trouvé.");
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données (PDO) : " . $e->getMessage());
}

// Connexion à la base via MySQLi (pour gestion des questions)
$conn = new mysqli("localhost", "root", "", "banquemoderne");
if ($conn->connect_error) {
    die("Erreur MySQLi : " . $conn->connect_error);
}

// Soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_question'])) {
    $question = $conn->real_escape_string($_POST['user_question']);
    $conn->query("INSERT INTO questions (user_question) VALUES ('$question')");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Récupération des questions
$questions = $conn->query("SELECT user_question, admin_response FROM questions ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
     <!-- Bootstrap JS Bundle (inclut Popper.js) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
 <style>
  body {
  background: linear-gradient(145deg, #e0e0e0,rgb(245, 245, 245));
  min-height: 100vh;
  padding: 40px 0;
  font-family: 'Poppins', sans-serif;
}
        .container-fluid {
            padding-top: 20px;
        }
 
        .content {
    padding: 50px 20px;
    min-height: 80vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
/* partie principal */ 

.container {
  max-width: 700px;
  margin: auto;
}

h2 {
    font-family: 'Poppins' ,sans-serif;
  font-weight: 600;
  font-size: 30px;
  color: #1b3d2f;
  padding: 20PX;
}

.card {

  border: none;
  border-radius: 20px;
  background-color: #ffffff;
  transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
  
}

.card:hover {
  transform: scale(1.01);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
}

.card-body {
  padding: 30px;
}
.card-glass {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  color: #2c3e50;
  transition: all 0.3s ease-in-out;
}

.card-glass:hover {
  transform: scale(1.01);
}
.card-title {
  font-size: 1.4rem;
  color: #164A41;
  font-weight: 600;
  margin-bottom: 20px;
  border-left: 4px solid #16a085;
  padding-left: 10px;
}
.profile-img {
  width: 130px;
  height: 130px;
  object-fit: cover;
  border-radius: 20%;
  border: 3px solid rgba(255, 255, 255, 0.4);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

p {
    font-family: 'Poppins', sans-serif;
  font-size: 20px;
  margin-bottom: 20px;
  color: #2c3e50;
}

strong {
  color: #0b5345;
}


.btn {
  border-radius: 12px;
  font-weight: 500;
  transition: all 0.3s ease-in-out;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.btn-success {
  background-color: #1abc9c;
  border: none;
}

.btn-outline-primary {
  border-color: #3498db;
  color: #3498db;
}

.btn-outline-primary:hover {
  background-color: #3498db;
  color: #fff;
}

.btn-outline-dark {
  border-color: #2c3e50;
  color: #2c3e50;
}

.btn-outline-dark:hover {
  background-color: #2c3e50;
  color: #fff;
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


                /*la maps */ 
  /* Style de la section */
  .location-section {
            text-align: center;
            padding: 50px;
            background:rgb(212, 221, 201);
            border-radius: 20px;
        }

        .location-section h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .location-section p {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Conteneur de la carte */
        .map-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #map {
            width: 600px;
            height: 400px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
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
     align-self: flex-end;
    text-align: right !important ;
}
.from-admin {
    background: #c8e6c9;
    align-self: flex-start;
    text-align: left !important; 
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

<!-- Contenu principal -->
<div class="content" style="background: linear-gradient(145deg, #e0e0e0, #f5f5f5); min-height: 100vh; padding: 50px 0;">
  <div class="container mt-5">
    <h2 class="text-center mb-5 text-dark fw-bold">
      Bienvenue sur votre compte, <?= htmlspecialchars($user['nom']) ?> !
    </h2>

  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success_message']) ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

    <div class="card shadow card-glass mx-auto" style="max-width: 700px;">
      <div class="card-body">
      <div class="row align-items-center">
          <!-- Partie photo -->
          <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="user.jpg" alt="Photo de profil" class="profile-img">
          </div>
             <!-- Partie infos -->
             <div class="col-md-8">
        <h5 class="card-title mb-4">Informations du compte</h5>

        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['telephone']) ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse']) ?></p>

        <hr class="my-4">

        <div class="d-flex flex-wrap justify-content-center gap-3">
         
          <a href="relev.php" class="btn btn-outline-primary px-4 py-2 rounded-pill">
            📜 Relevé de compte
          </a>
          <a href="modifiercompte.php" class="btn btn-outline-primary px-4 py-2 rounded-pill">
            modifier mon compte
          </a>

          </a>
        </div>
      </div>
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
    <div class="message from-admin">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>
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
