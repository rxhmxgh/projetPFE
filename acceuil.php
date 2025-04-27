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
    background-color:#adbc9f; 
    padding: 40px;
    width: 30%;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
    position: relative;
    font-family: 'Poppins', sans-serif;
    
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
    font-size: 1.2em;
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
            <h1><strong>Bienvenue chez banque BADRLINE .</strong></h1>
            
            <center><p>Nous sommes votre partenaire financier de confiance.<br/>
             Nous mettons à votre disposition des services bancaires modernes et accessibles pour accompagner vos projets et faciliter votre gestion financière.<br/>
             Découvrez nos solutions adaptées à vos besoins et profitez d’une expérience bancaire simplifiée et sécurisée.</p></center>
            <a href="connex.php" class="btn">Se connecter →</a>
        </div>
    </section>

    <div class="cta-section">
      <h2 class="cta-text">Rejoignez-nous dès aujourd’hui et profitez d’une gestion bancaire moderne et sans contraintes !</h2>
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
    <section class="offres">
        <h1>Ce Que Nous Offrons</h1>
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
   
   
<section id="contacte" class="contact-section">
    <div class="contact-container">
        <div class="contact-info">
            <h1>Contactez-Nous</h1>
            <p>Nous sommes là pour répondre à vos questions !</p>
            <p><strong>+213 (0)21 989 323</strong></p>
            <p>badrlinebanque-dz@gmail.com</p>
        </div>
        <div class="contact-form" >
        <form id="contact-form">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

               <button type="submit">Contactez-Nous</button>
                </form> 
        </div>
    </div>
   
</section>


<script>
      (function () {
        emailjs.init("UA8naRzna1HefVjV9"); // PUBLIC KEY sur site
      })();

      function sendEmail() {

        emailjs
          .send("service_0v5y3fp", "template_x0rfy3m", { // SERVICE ID / TEMPLATE ID
            to_name: "Banque",
            from_name: "BadrLine",
            message: "Un nouveau email !",
            reply_to: "rahmaghomari26@gmail.com",
          })
          .then(
            function (response) {
              alert("Email envoyé avec succès !");
              document.getElementById("contact-form").reset();
            },
            function (error) {
              console.error("EmailJS Error:", error);
              alert("Erreur lors de l'envoi de l'email: " + JSON.stringify(error));
            }
          );
          const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;

        if (!name || !email ) {
            alert("Veuillez remplir tous les champs.");
            return;
        }

      }
    </script>



<footer>
    <p>&copy; 2025 Banque BADRLINE . Tous droits réservés.</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</body>
</html>