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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    
   <style>
    
               body {
                font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            background: #f3e8d3;
            font-family: 'Poppins', sans-serif;
        }
/* Smartphones */
@media (max-width: 600px) {
    .container {
        padding: 1rem;
    }
    .menu {
        flex-direction: column;
    }
}

/* Tablettes */
@media (min-width: 601px) and (max-width: 1024px) {
    .container {
        padding: 2rem;
    }
}
 
@media (max-width: 768px) {
    .container {
        padding: 0.5rem;
    }
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: auto;
    padding: 1rem;
}

/* header */
        header {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #133215;
            color: white;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        nav ul {
            list-style: none;
            display: flex;
              gap: 20px;
        }
              nav a {
            text-decoration: none;
            color: white;
            transition: color 0.3s;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
    
        

        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            text-align: center;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('banking..jpg') center/cover no-repeat;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #ff9800;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .info-container {
    background: rgba(0, 128, 0, 0.7); /* Vert transparent */
    padding: 30px;
    border-radius: 15px;
    margin: 20px auto;
    width: 90%;
    max-width: 1200px;
}

.section {
            padding: 40px;
            text-align: center;
            background: #92b775;
            margin: 40px auto;
            border-radius: 0px;
            font-family: 'Poppins', sans-serif;
            color: black;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

      
        .btn-primary {
            background: #ff9800;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }
        /* From Uiverse.io by gharsh11032000 */ 
.card {
  width: 400px; /* Augmenter la taille */
  height: 300px; /* Augmenter la taille */
  background: linear-gradient(-45deg, #f89b29 0%, #92b775 100%);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}


.card svg {
  width: 48px;
  fill: #333;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.card:hover {
  transform: rotate(-5deg) scale(1.1);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.card__content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
  width: 100%;
  height: 100%;
  padding: 20px;
  box-sizing: border-box;
  background-color: #f3e8d3;
  opacity: 0;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.card:hover .card__content {
  transform: translate(-50%, -50%) rotate(0deg);
  opacity: 1;
}

.card__title {
  margin: 0;
  font-size: 24px;
  color: #333;
  font-weight: 700;
}

.card__description {
  margin: 10px 0 0;
  font-size: 14px;
  color: #777;
  line-height: 1.4;
}

.card:hover svg {
  scale: 0;
  transform: rotate(-45deg);
}

.cards-container {
  display: flex; /* Aligner horizontalement */
  justify-content: center; /* Centrer les cartes */
  align-items: center; /* Aligner verticalement */
  gap: 20px; /* Espacement entre les cartes */
  background-color: #133215; /* Fond blanc */
  padding: 20px; /* Espacement intérieur */
}

/* partie des carte (2)*/
.offres h1 {
  color: black;
  font-family: 'Poppins', sans-serif;
}
h1 {
    font-size: 2.5em;
    margin: 20px 0;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    
}

.cartes {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.carte {
    position: relative;
    width: 300px;
    height: 350px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.carte img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display:flex;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); /* Assombrissement */
}

.contenu {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: white;
    z-index: 2;
    width: 80%;
}

.contenu p {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 10px;
}

button {
    background-color:#92b775;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color:#f89b29;
}



.cta-section {
    text-align: center;
    padding: 20px;
    background: linear-gradient(45deg, #436850, #adbc9f); /* Dégradé attractif */
    border-radius:0px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.cta-text {
    font-size: 36px;
    font-weight: bold;
    color: white;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* partie de rejoindre */
.bloc-inscription {
    background-color: #adbc9f;
    padding: 40px;
    width: 90%;
    max-width: 400px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
    position: relative;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}

.bloc-inscription::before {
    content: "";
    position: absolute;
    top: -10px;
    left: -10px;
    width: 100%;
    height: 100%;
    border: 2px solid #133215;
    transform: rotate(2deg);
    z-index: -1;
    box-sizing: border-box;
}

.titre {
    font-size: 2.5em;
    color: black;
}

.description {
    font-size: 1.1em;
    color: black;
}

.liste-avantages {
    list-style: none;
    padding: 0;
    font-size: 1em;
}

.avantage {
    margin: 5px 0;
}

.bouton-action {
    display: block;
    margin: 20px auto 0;
    padding: 12px 25px;
    background-color:#92b775;
    color: white;
    font-size: 1.2em;
    font-weight: bold;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background 0.3s;
}

.bouton-action:hover {
    background-color:#f89b29;
}

/* Media Queries pour améliorer l'affichage sur tablettes et petits écrans */
@media (min-width: 768px) {
    .bloc-inscription {
        width: 60%;
    }

    .titre {
        font-size: 2.2em;
    }

    .description,
    .liste-avantages {
        font-size: 1.1em;
    }

    .bouton-action {
        font-size: 1.1em;
    }
}

@media (min-width: 1024px) {
    .bloc-inscription {
        width: 40%;
    }

    .titre {
        font-size: 2.5em;
    }

    .description,
    .liste-avantages {
        font-size: 1.2em;
    }

    .bouton-action {
        font-size: 1.2em;
    }
}
.icone-rouge {
    position: absolute;
    top: -20px; /* Ajuste la position verticale */
    right: 20px; /* Ajuste la position horizontale */
}

.icone-rouge img {
    width: 50px; /* Ajuste la taille */
    height: auto;
}


.services-container {
    padding: 50px;
    max-width: 1000px;
    margin: auto;
}

.intro h1 {
    color: #2c3e50;
}

.services-container {
            padding: 50px;
            max-width: 1000px;
            margin: auto;
            text-align: center;
        }
        .intro h1 {
            color:black;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .intro p {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
        .services {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        .service {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 30%;
            min-width: 250px;
            text-align: center;
        }
       
        .service h3 {
            color:#436850;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .service p {
            color: #444;
            font-size: 1rem;
            line-height: 1.5;
        }

/* taux de change */
 .marquee-container {
      background-color: white;
      color: green;
      overflow: hidden;
      white-space: nowrap;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-top: 2px solid green;
      border-bottom: 2px solid green;
    }

    .marquee-text {
      display: inline-block;
      padding-left: 100%;
      animation: scroll-left 15s linear infinite;
      font-size: 1.2rem;
      font-weight: bold;
    }

    @keyframes scroll-left {
      0% {
        transform: translateX(0%);
      }
      100% {
        transform: translateX(-100%);
      }
    }
        /*la maps */ 
  /* Style de la section */
  .location-section {
            text-align: center;
            padding: 50px;
            background: #f8f9fa;
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
            width: 400px;
            height: 300px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        }
/* Style de la notification */
 .notification {
    display: none;
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    font-size: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}
/* Style de la section contact */
.contact-section {
    background:#f3e8d3;
    padding: 20px;
    display: flex;
    justify-content: center;
}

.contact-container {
    display: flex;
    justify-content: space-between;
    width: 80%;
    max-width: 1000px;
}

.contact-info {
    width: 40%;
    margin: 5px 0;
    font-size: 16px;
}

.contact-info h1 {
    font-size: 2em;
    color: #000;
    margin-bottom: 10px;
}

.contact-info p {
    font-size: 1.1em;
    font-family: 'poppins' ,sans-serif;
    color:black;
    margin-bottom: 10px;
}

.contact-form {
    width: 50%;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #000;
    border-radius: 5px;
}

button {
    background: orange;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    cursor: pointer;
    border-radius: 10px;
    font-weight: bold;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
}

label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }


footer {
    text-align: center;
    padding: 10px;
    background:#133215;
    font-size: 0.9em;
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

button img {
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
    <header>
        <div class="logo">BADR LINE </div>
        <nav>
            <ul>
                <li><a href="inscription.php">S'inscrire</a></li>   
                <li><a href="#about">Plus infos</a></li>
                <li><a href="#contacte">Contacte</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="hero">
        <div class="hero-content">
            <h1><strong>Bienvenue chez banque BADRLINE</strong></h1>
            
            <center><p>Nous sommes votre partenaire financier de confiance.<br/>
             Nous mettons à votre disposition des services bancaires modernes et accessibles pour accompagner vos projets et faciliter votre gestion financière.<br/>
             Découvrez nos solutions adaptées à vos besoins et profitez d’une expérience bancaire simplifiée et sécurisée.</p></center>
            <a href="connex.php" class="btn">Se connecter →</a>
        </div>
    </section>

    <div class="cta-section">
      <h2 class="cta-text">Rejoignez-nous dès aujourd’hui et profitez d’une gestion bancaire moderne et sans contraintes !</h2>
  </div>
<!-- taux de change -->
  <div class="marquee-container">
    <div class="marquee-text">
       Banque El Badr - Taux de change aujourd'hui : 1 EUR = 146.30 DZD | 1 USD = 135.20 DZD | 1 DZD = 0.0068 EUR |  TAUX DE CHANGE SUR BADR LINE 
    </div>
  </div>  


     <!-- div for card (3)-->
    
     <div class="cards-container">
      <!-- From Uiverse.io by gharsh11032000 --> 
<div class="card">
  <img src="homebank-1920.jpg" alt="Image 1" width="100%" height="100%">
  <div class="card__content">
    <p class="card__title"><strong>Gérez vos comptes à distance.</strong> 
    </p><p class="card__description">Effectuez vos opérations bancaires en toute sécurité depuis chez vous : virements, consultation de solde, gestion de cartes et bien plus encore.</p>
  </div>
</div>

      <!-- From Uiverse.io by gharsh11032000 --> 
<div class="card">
  <img src="simulation.jpg" alt="Image 2" width="100%" height="100%">
  <div class="card__content">
    <p class="card__title"><strong>Simulation de crédit.</strong>
    </p><p class="card__description"> Utilisez notre simulateur pour calculer vos mensualités et trouver l’offre de prêt qui vous convient.</p>
  </div>
</div>

      <!-- From Uiverse.io by gharsh11032000 --> 
<div class="card">
<img src="ouverturecompte.jpg" alt="Image 3" style="width: 100%; ; height: 100% ;  object-fit: cover;">
  <div class="card__content">
    <p class="card__title">Ouverture de compte.
    </p><p class="card__description">Ouvrez un compte sur BADRLINE  en quelques étapes simples et profitez de nos services adaptés à vos besoins.</p>
  </div>
</div>
 </div> <!-- fin de div of card -->
     </div>

    <!--de plus a ajouter -->
    < class="offres">
        <div class="offres" >
        <h1>Ce Que Nous Offrons</h1>
        </div>
        <div class="cartes">
            <div class="carte">
                <img src="gererargent.jpg" alt="Services Bancaires">
                <div class="overlay"></div>
                <div class="contenu">
                    <p>Gérez Votre Argent en Toute Simplicité</p>
                    <button onclick="location.href='demande.php'">Ouvrir Un Compte</button>
                </div>
            </div>
            <div class="carte">
                <img src="agence.png" alt="Investissements">
                <div class="overlay"></div>
                <div class="contenu">
                    <p>Nos services</p>
                    <button onclick="location.href='connex.php'">En Savoir Plus</button>
                </div>
            </div>
            <div class="carte">
                <img src="localisation.jpg" alt="Assurances">
                <div class="overlay"></div>
                <div class="contenu">
                    <p> Besoin d’une Agence ? Suivez la Carte !</p>
                    <button onclick="location.href='#carte'">Découvrir</button>
                </div>
            </div>
        </div>
    </section>
    

    <!--barrre des infos -->
    <div class="section" id="about">
      <h2><strong>À propos de nous</strong></h2>
      <p>Bienvenue sur BADRLINE , votre plateforme bancaire interactive conçue pour simplifier et enrichir votre expérience financière.

        Notre mission est de vous offrir un accès fluide, sécurisé et intuitif aux services bancaires, où que vous soyez. Grâce à une interface moderne et des outils intelligents, nous mettons à votre disposition : <br/>
        <strong>Consultation des services bancaires :</strong> Découvrez nos offres de comptes, crédits et solutions d’épargne adaptées à vos besoins. <br/>
       <strong>Chatbot intelligent :</strong>  Obtenez des réponses instantanées à vos questions et une assistance personnalisée en temps réel.<br/>
        <strong>Simulateur de prêt :</strong> Évaluez vos options de financement en quelques clics. <br/>
        <strong>Localisation des agences et GAB :</strong> Trouvez rapidement une agence ou un guichet automatique à proximité.<br/>
        Chez BADRLINE , nous nous engageons à innover pour vous offrir des services bancaires modernes, accessibles et sécurisés. Rejoignez-nous dès aujourd’hui et découvrez une nouvelle façon de gérer vos finances en toute simplicité !
      </p>
  </div>

  

  <div class="section" id="why-choose">
      <h2><strong>Pourquoi nous choisir ?</strong> </h2>
      <p> <strong>banque, accessible partout et à tout moment.<br/></strong> 
        Avec notre plateforme digitale, gérez vos comptes et services bancaires en ligne 24/7 en toute simplicité et sécurité. Nous mettons à votre disposition des outils innovants tels qu’un chatbot intelligent,
       un simulateur de prêt et un système de gestion financière avancé pour vous accompagner dans vos décisions.<br/>
       <strong>Un réseau étendu et un accompagnement personnalisé.<br/></strong>
       Trouvez rapidement une agence ou un guichet grâce à notre outil de géolocalisation et bénéficiez de conseils sur mesure adaptés à vos besoins.<br/>
       <strong>Une banque tournée vers l’avenir.<br/></strong>
Grâce à des technologies de pointe, nous vous offrons des services sécurisés, fluides et évolutifs pour une expérience bancaire optimisée.<br/>
  </div>
  <!-- Rejoignez-Nous -->
  <section class="bloc-inscription">
    <div class="contenu-texte">
        <h1 class="titre">Rejoignez-Nous</h1>
        <p class="description">
            Ne restez pas sur la touche! Rejoignez notre communauté de clients satisfaits et commencez à profiter de nos services dès aujourd'hui! <br/>
            Facile, Rapide, Sûr
        </p>
        <div class="icone-rouge">
            <img src="icon.png" alt="Icône rouge">
        </div>
        
        <ul class="liste-avantages">
            <li class="avantage">✓ Aucun frais </li>
            <li class="avantage">✓ Service rapide</li>
            <li class="avantage">✓ Assistance 24/7</li>
            <li class="avantage">✓ Taux compétitifs</li>
            <li class="avantage">✓ Satisfaction client</li>
        </ul>
        
        <button onclick="location.href='inscription.php'"  class="bouton-action">Inscrivez-Vous</button>   <!-- lien directe vers formulaire d'inscription -->
    </div>
</section>

<!--partie des services bancaire-->
<section id="services" class="services-container">
    <div class="intro">
        <h1>Découvrez nos services bancaires</h1>
        <p>Gérez votre argent facilement et en toute sécurité avec nos services modernes.</p>
    </div>
    <div class="services">
        <div class="service">

            <h3>Ouverture de compte</h3>
            <p>Créez un compte sur BADRLINE  rapidement et commencez à gérer vos finances en toute simplicité.</p>
        </div>
        <div class="service">
      
            <h3>Paiements et Transactions</h3>
            <p>Effectuez vos paiements en ligne, transferts d'argent et transactions sécurisées facilement.</p>
        </div>
        <div class="service">
        
            <h3>Services Bancaires en Ligne</h3>
            <p>Accédez à votre banque depuis votre ordinateur et gérez votre argent 24/7.</p>
        </div>
    </div>
</section>

<!-- Section de la localisation -->
<section id="carte" class="location-section">
    <h2>Notre Agence à Mostaganem</h2>
    <p>Retrouvez-nous facilement grâce à notre carte interactive.</p>

    <!-- Conteneur de la carte -->
    <div class="map-container">
        <div id="map"></div>
    </div>
</section>

<!-- Script Leaflet.js -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    // Initialisation de la carte centrée sur Mostaganem
    var map = L.map('map').setView([35.95, 0.25], 10);

    // Ajout du fond de carte OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
// les agences a proximité
const agences = [
        { nom: "Mostaganem", coords: [35.9312, 0.0895], description: "Agence Mostaganem Centre" },
        { nom: "Sidi Lakhdar", coords: [36.1056, 0.2790], description: "Agence Sidi Lakhdar" },
        { nom: "Mesra", coords: [35.8833, 0.2000], description: "Agence Mesra" },
        { nom: "Aïn Tédelès", coords: [35.9761, 0.2392], description: "Agence Aïn Tédelès" },
        { nom: "Bouguirat", coords: [35.7403, 0.2432], description: "Agence Bouguirat" },
        { nom: "Achaacha", coords: [36.1956, 0.3953], description: "Agence Achaacha" }
    ];

    // Ajout d'un marqueur sur Mostaganem
    agences.forEach(agence => {
        //sidi lakhdar
    L.marker([36.1056, 0.2790]).addTo(map)
        .bindPopup('<b>Agence</b><br>Sidi Lakhdar, Mostaganem')
        .openPopup(); 
        

    //Mesra 
    L.marker([35.8833, 0.2000]).addTo(map)
        .bindPopup('<b>Agence</b><br>Mesra,Mostaganem')
        .openPopup(); 
    //ain tedles 
    L.marker([35.9761, 0.2392]).addTo(map)
        .bindPopup('<b>Agence</b><br>Aïn Tédelès, Mostaganem')
        .openPopup(); 
     //Bouguirat
     L.marker([35.7403, 0.2432]).addTo(map)
        .bindPopup('<b>Agence</b><br>Bouguirat, Mostaganem')
        .openPopup(); 
     //Achaacha 
     L.marker([36.1956, 0.3953]).addTo(map)
        .bindPopup('<b>Agence</b><br>Achaacha, Mostaganem')
        .openPopup(); 
        });
    // Ouvrir seulement celle de Mostaganem au début
L.marker([35.9312, 0.0895]).addTo(map)
    .bindPopup('<b>Mostaganem</b><br>Agence principale , Algérie')
    .openPopup();
</script>


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
<!-- Formulaire de contact -->
<section id="contacte" class="contact-section">
  <div class="contact-container">
    <div class="contact-info">
      <h1>Contactez-Nous</h1>
      <p>Nous sommes là pour répondre à vos questions !</p>
      <p><strong>+213 (0)21 989 323</strong></p>
      <p>badrlinebanque-dz@gmail.com</p>
    </div>
    <form action="send.php" method="post"></form>
<div class="contact-form">
  <form action="send.php" method="post" id="contact-form">
    <div class="form-group">
      <label for="name">Nom</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" required></textarea>
    </div>

    <!-- Bouton de soumission -->
    <button type="submit">Envoyer</button>
  </form>
</div> 
  </div>
</section>



 <footer>
    <p>&copy; 2025 Banque BADRLINE . Tous droits réservés.</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
</body>
</html>