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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Bootstrap JS Bundle (inclut Popper.js) -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Demande carte bancaire</title>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    position: relative;
    overflow-x: hidden;
    background: linear-gradient(135deg, #eef2f3, #d9dde0);
}
.contenu {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 70px 60px;
  flex-wrap: wrap;
  gap: 40px;
}
/* partie principal */


.container {
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    margin: auto;
}


.landing-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 60px;
  max-width: 1200px;
  margin: auto;
  gap: 40px;
}

.text-side {
  flex: 1;
}

.text-side h1 {
  font-size: 36px;
  color:rgb(31, 33, 35);
  margin-bottom: 20px;
}

.highlight {
  color:rgb(27, 83, 10);;
}

.text-side p {
  margin-top: 10px;
  font-size: 18px;
  color: #555;
}

.features {
  margin-top: 20px;
  list-style: none;
  padding-left: 0;
}

.features li {
  margin-bottom: 10px;
  font-size: 16px;
}

.cta-buttons {
  margin-top: 30px;
}

.btn {
  padding: 12px 24px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s ease;
  display: inline-block;
}


.btn-secondary {
  background-color: rgba(255, 255, 255, 0.6);;
  color: rgba(255, 255, 255, 0.6);
}

.btn-secondary:hover {
  background-color: rgba(255, 255, 255, 0.6);;
}

/* Photo de profil */
.photo-side {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.profile-img {
  width: 400px;
  height: 400px;
  border-radius: 40%;
  object-fit: cover;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

/* Responsive */
@media (max-width: 768px) {
  .landing-container {
    flex-direction: column;
    text-align: center;
    padding: 30px;
  }

  .photo-side {
    margin-top: 30px;
  }
}

/* demande css */
.form-container {
  background: #ffffffcc;
  border-radius: 20px;
  padding: 40px;
  max-width: 600px;
  margin: 60px auto;
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}

.form-container h2 {
  text-align: center;
  color: black;
  margin-bottom: 30px;
  font-family: 'Poppins' , sans-serif;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 12px;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 16px;
  outline: none;
  transition: border-color 0.2s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  border-color:  #f89b29;
}

button[type="submit"] {
  
            background: #4CAF50;
            border: none;
            padding: 8px 12px;
            border-radius: 5%;
            cursor: pointer;
      
  transition: background-color 0.3s;
}

button[type="submit"]:hover {
  background-color:rgb(195, 228, 178);
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

        /* css carte */
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
/* From Uiverse.io by Praashoo7 */ 
.flip-card {
  background-color: transparent;
  width: 240px;
  height: 154px;
  perspective: 1000px;
  color: white;
}

.heading_8264 {
  position: absolute;
  letter-spacing: .2em;
  font-size: 0.5em;
  top: 2em;
  left: 18.6em;
}

.logo {
  position: absolute;
  top: 6.8em;
  left: 11.7em;
}

.chip {
  position: absolute;
  top: 2.3em;
  left: 1.5em;
}

.contactless {
  position: absolute;
  top: 3.5em;
  left: 12.4em;
}

.number {
  position: absolute;
  font-weight: bold;
  font-size: .6em;
  top: 8.3em;
  left: 1.6em;
}

.valid_thru {
  position: absolute;
  font-weight: bold;
  top: 635.8em;
  font-size: .01em;
  left: 140.3em;
}

.date_8264 {
  position: absolute;
  font-weight: bold;
  font-size: 0.5em;
  top: 13.6em;
  left: 3.2em;
}

.name {
  position: absolute;
  font-weight: bold;
  font-size: 0.5em;
  top: 16.1em;
  left: 2em;
}

.strip {
  position: absolute;
  background-color: black;
  width: 15em;
  height: 1.5em;
  top: 2.4em;
  background: repeating-linear-gradient(
    45deg,
    #303030,
    #303030 10px,
    #202020 10px,
    #202020 20px
  );
}

.mstrip {
  position: absolute;
  background-color: rgb(255, 255, 255);
  width: 8em;
  height: 0.8em;
  top: 5em;
  left: .8em;
  border-radius: 2.5px;
}

.sstrip {
  position: absolute;
  background-color: rgb(255, 255, 255);
  width: 4.1em;
  height: 0.8em;
  top: 5em;
  left: 10em;
  border-radius: 2.5px;
}

.code {
  font-weight: bold;
  text-align: center;
  margin: .2em;
  color: black;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  box-shadow: 0 8px 14px 0 rgba(0,0,0,0.2);
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  border-radius: 1rem;
}

.flip-card-front {
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
  background-color:rgb(35, 74, 17);
}

.flip-card-back {
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
  background-color:rgb(35, 74, 17);
  transform: rotateY(180deg);
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

    <!-- From Uiverse.io by Praashoo7 --> 
     <div class="contenu">
     <div class="bloc-gauche">
     <h2 class="titre-avec-trait">DEMANDE DE CARTE ET CHEQUE</h2>
     <div class="trait-horizontal"></div>
     </div>
<div class="flip-card">
    <div class="flip-card-inner">
        <div class="flip-card-front">
            <p class="heading_8264">CARTE BANCAIRE</p>
            <svg class="logo" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="36" height="36" viewBox="0 0 48 48">
            <path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"></path><path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"></path><path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"></path>
            </svg>
            <svg version="1.1" class="chip" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 50 50" xml:space="preserve">  <image id="image0" width="50" height="50" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUAAACNcTiVeUKVeUOY
              fEaafEeUeUSYfEWZfEaykleyklaXe0SWekSZZjOYfEWYe0WXfUWXe0WcgEicfkiXe0SVekSXekSW
              ekKYe0a9nF67m12ZfUWUeEaXfESVekOdgEmVeUWWekSniU+VeUKVeUOrjFKYfEWliE6WeESZe0GS
              e0WYfES7ml2Xe0WXeESUeEOWfEWcf0eWfESXe0SXfEWYekSVeUKXfEWxklawkVaZfEWWekOUekOW
              ekSYfESZe0eXekWYfEWZe0WZe0eVeUSWeETAnmDCoWLJpmbxy4P1zoXwyoLIpWbjvXjivnjgu3bf
              u3beunWvkFWxkle/nmDivXiWekTnwXvkwHrCoWOuj1SXe0TEo2TDo2PlwHratnKZfEbQrWvPrWua
              fUfbt3PJp2agg0v0zYX0zYSfgkvKp2frxX7mwHrlv3rsxn/yzIPgvHfduXWXe0XuyIDzzISsjVO1
              lVm0lFitjVPzzIPqxX7duna0lVncuHTLqGjvyIHeuXXxyYGZfUayk1iyk1e2lln1zYTEomO2llrb
              tnOafkjFpGSbfkfZtXLhvHfkv3nqxH3mwXujhU3KqWizlFilh06khk2fgkqsjlPHpWXJp2erjVOh
              g0yWe0SliE+XekShhEvAn2D///+gx8TWAAAARnRSTlMACVCTtsRl7Pv7+vxkBab7pZv5+ZlL/UnU
              /f3SJCVe+Fx39naA9/75XSMh0/3SSkia+pil/KRj7Pr662JPkrbP7OLQ0JFOijI1MwAAAAFiS0dE
              orDd34wAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IDx2lsiuJAAACLElEQVRIx2Ng
              GAXkAUYmZhZWPICFmYkRVQcbOwenmzse4MbFzc6DpIGXj8PD04sA8PbhF+CFaxEU8iWkAQT8hEVg
              OkTF/InR4eUVICYO1SIhCRMLDAoKDvFDVhUaEhwUFAjjSUlDdMiEhcOEItzdI6OiYxA6YqODIt3d
              I2DcuDBZsBY5eVTr4xMSYcyk5BRUOXkFsBZFJTQnp6alQxgZmVloUkrKYC0qqmji2WE5EEZuWB6a
              lKoKdi35YQUQRkFYPpFaCouKIYzi6EDitJSUlsGY5RWVRGjJLyxNy4ZxqtIqqvOxaVELQwZFZdkI
              JVU1RSiSalAt6rUwUBdWG1CP6pT6gNqwOrgCdQyHNYR5YQFhDXj8MiK1IAeyN6aORiyBjByVTc0F
              qBoKWpqwRCVSgilOaY2OaUPw29qjOzqLvTAchpos47u6EZyYnngUSRwpuTe6D+6qaFQdOPNLRzOM
              1dzhRZyW+CZouHk3dWLXglFcFIflQhj9YWjJGlZcaKAVSvjyPrRQ0oQVKDAQHlYFYUwIm4gqExGm
              BSkutaVQJeomwViTJqPK6OhCy2Q9sQBk8cY0DxjTJw0lAQWK6cOKfgNhpKK7ZMpUeF3jPa28BCET
              amiEqJKM+X1gxvWXpoUjVIVPnwErw71nmpgiqiQGBjNzbgs3j1nus+fMndc+Cwm0T52/oNR9lsdC
              S24ra7Tq1cbWjpXV3sHRCb1idXZ0sGdltXNxRateRwHRAACYHutzk/2I5QAAACV0RVh0ZGF0ZTpj
              cmVhdGUAMjAyMy0wMi0xM1QwODoxNToyOSswMDowMEUnN7UAAAAldEVYdGRhdGU6bW9kaWZ5ADIw
              MjMtMDItMTNUMDg6MTU6MjkrMDA6MDA0eo8JAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTAy
              LTEzVDA4OjE1OjI5KzAwOjAwY2+u1gAAAABJRU5ErkJggg=="></image>
            </svg>
            <svg version="1.1" class="contactless" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 50 50" xml:space="preserve">  <image id="image0" width="50" height="50" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAQAAAC0NkA6AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
              cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IEzgIwaKTAAADDklEQVRYw+1XS0iUURQ+f5qPyjQf
              lGRFEEFK76koKGxRbWyVVLSOgsCgwjZBJJYuKogSIoOonUK4q3U0WVBWFPZYiIE6kuArG3VGzK/F
              fPeMM/MLt99/NuHdfPd888/57jn3nvsQWWj/VcMlvMMd5KRTogqx9iCdIjUUmcGR9ImUYowyP3xN
              GQJoRLVaZ2DaZf8kyjEJALhI28ELioyiwC+Rc3QZwRYyO/DH51hQgWm6DMIh10KmD4u9O16K49it
              VoPOAmcGAWWOepXIRScAoJZ2Frro8oN+EyTT6lWkkg6msZfMSR35QTJmjU0g15tIGSJ08ZZMJkJk
              HpNZgSkyXosS13TkJpZ62mPIJvOSzC1bp8vRhhCakEk7G9/o4gmZdbpsTcKu0m63FbnBP9Qrc15z
              bkbemfgNDtEOI8NO5L5O9VYyRYgmJayZ9nPaxZrSjW4+F6Uw9yQqIiIZwhp2huQTf6OIvCZyGM6g
              DJBZbyXifJXr7FZjGXsdxADxI7HUJFB6iWvsIhFpkoiIiGTJfjJfiCuJg2ZEspq9EHGVpYgzKqwJ
              qSAOEwuJQ/pxPvE3cYltJCLdxBLiSKKIE5HxJKcTRNeadxfhDiuYw44zVs1dxKwRk/uCxIiQkxKB
              sSctRVAge9g1E15EHE6yRUaJecRxcWlukdRIbGFOSZCMWQA/iWauIP3slREHXPyliqBcrrD71Amz
              Z+rD1Mt2Yr8TZc/UR4/YtFnbijnHi3UrN9vKQ9rPaJf867ZiaqDB+czeKYmd3pNa6fuI75MiC0uX
              XSR5aEMf7s7a6r/PudVXkjFb/SsrCRfROk0Fx6+H1i9kkTGn/E1vEmt1m089fh+RKdQ5O+xNJPUi
              cUIjO0Dm7HwvErEr0YxeibL1StSh37STafE4I7zcBdRq1DiOkdmlTJVnkQTBTS7X1FYyvfO4piaI
              nKbDCDaT2anLudYXCRFsQBgAcIF2/Okwgvz5+Z4tsw118dzruvIvjhTB+HOuWy8UvovEH6beitBK
              xDyxm9MmISKCWrzB7bSlaqGlsf0FC0gMjzTg6GgAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjMtMDIt
              MTNUMDg6MTk6NTYrMDA6MDCjlq7LAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIzLTAyLTEzVDA4OjE5
              OjU2KzAwOjAw0ssWdwAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyMy0wMi0xM1QwODoxOTo1Nisw
              MDowMIXeN6gAAAAASUVORK5CYII="></image>
            </svg>
            <p class="number">9759 2484 5269 6576</p>
           <!--  <p class="valid_thru">VALID THRU</p>   -->
            <p class="date_8264">1 2 / 2 4</p>
            <p class="name">EL-BAD</p>
        </div>
        <div class="flip-card-back">
            <div class="strip"></div>
            <div class="mstrip"></div>
            <div class="sstrip">
              <p class="code">***</p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- contenu principal -->
<div class="landing-container">
  <div class="text-side">
    <h1>Allez plus loin avec <span class="highlight">BADRLINE  Banque</span></h1>
    <p>Découvrez nos solutions modernes pour gérer votre argent plus facilement : carte bancaire, chéquier, et services à distance adaptés à vos besoins.</p>
    <ul class="features">
      <li>✔️ Commande facile en ligne</li>
      <li>✔️ Suivi de traitement en temps réel</li>
      <li>✔️ Sécurité et confidentialité garanties</li>
    </ul>
    <div class="cta-buttons">
    <h2> Étapes pour faire une demande</h2>
      <ol>
        <li>Connectez-vous à votre espace personnel.</li>
        <li>Accédez à <strong>"Demande de carte et chèque"</strong>.</li>
        <li>Remplissez et validez le formulaire.</li>
        <li>Un conseiller traitera votre demande.</li>
        <li>Vous serez notifié dès disponibilité.</li>
      </ol>
    </div>
  </div>


  <div class="photo-side">
    <img src="demandecarte.jpg" alt="Photo de profil" class="profile-img">
  </div>
</div>
</div>


<!-- demande-->
<div class="form-container">
  <h2>Formulaire de Demande</h2>
  <form action="traitement_demande.php" method="POST">
    <div class="form-group">
      <label for="nom">Nom complet</label>
      <input type="text" id="nom" name="nom" required>
    </div>

    <div class="form-group">
      <label for="email">Adresse e-mail</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="type">Type de demande</label>
      <select id="type" name="type" required>
        <option value="">-- Sélectionnez --</option>
        <option value="carte">Carte Bancaire</option>
        <option value="chequier">Chéquier</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary"> Envoyer la demande</button>
  </form>
</div>










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