<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Rendez-vous Bancaires</title>
   <!-- Bootstrap JS Bundle (inclut Popper.js) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://lottie.host/693df874-655c-4449-891d-ba4f59872018/OBMcLhewqQ.lottie">
  <style>
    /* Variables globales */
:root {
  --primary-color: #28a745; /* Vert */
  --secondary-color: #ff9900; /* Orange */
  --background-color: #ffffff; /* Blanc */
  --text-color: #333333;
}


body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
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


        

/* Main */
.main {
  padding: 2rem 0;
}

.hero {
  text-align: center;
  padding: 2rem;
}

.hero h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.btn-primary {
  background-color: var(--secondary-color);
  color: var(--background-color);
  border: none;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  cursor: pointer;
  border-radius: 5px;
}

.btn-primary:hover {
  background-color: #e68a00;
}

/* Formulaire */
.form-section {
  padding: 2rem;
  background-color: #f9f9f9;
}

.hidden {
  display: none;
}

.form-step {
  margin-bottom: 1.5rem;
}

.form-step label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
}

.form-step input,
.form-step select {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.btn-secondary {
  background-color: var(--primary-color);
  color: var(--background-color);
  border: none;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  cursor: pointer;
  border-radius: 5px;
}

.btn-secondary:hover {
  background-color: #218838;
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
            <a class="nav-link" href="rendezvous.php" onclick="loadPage('rendez-vous')">Rendez-Vous</a>
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

  <!-- Section principale -->
  <main class="main">
    <section id="home" class="hero">
      <div class="container">
        <h2>Prenez rendez-vous avec votre conseiller en quelques clics !</h2>
        <button class="btn-primary" onclick="showAppointmentForm()">Réserver un rendez-vous</button>
      </div>
    </section>

    <!-- Formulaire de prise de rendez-vous -->
    <section id="appointment-form" class="form-section hidden">
      <div class="container">
        <h3>Réservez votre rendez-vous</h3>
        <form id="appointment-form-content">
          <!-- Étape 1 : Type de service -->
          <div class="form-step">
            <label for="service">Type de service :</label>
            <select id="service" name="service" required>
              <option value="">-- Sélectionnez un service --</option>
              <option value="ouverture-compte">Ouverture de compte</option>
              <option value="pret-immobilier">Prêt immobilier</option>
              <option value="gestion-patrimoine">Gestion de patrimoine</option>
              <option value="autre">Autre</option>
            </select>
          </div>

          <!-- Étape 2 : Date et heure -->
          <div class="form-step">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>
            <label for="time">Heure :</label>
            <input type="time" id="time" name="time" required>
          </div>

          <!-- Étape 3 : Informations personnelles -->
          <div class="form-step">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" required>
            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" placeholder="Votre e-mail" required>
            <label for="phone">Téléphone :</label>
            <input type="tel" id="phone" name="phone" placeholder="Votre téléphone" required>
          </div>

          <!-- Bouton de confirmation -->
          <button type="submit" class="btn-secondary">Confirmer</button>
        </form>
      </div>
    </section>
  </main>

  <!-- partie js -->
   <script>
  // Afficher/cacher le formulaire de rendez-vous
function showAppointmentForm() {
  const formSection = document.getElementById('appointment-form');
  formSection.classList.toggle('hidden');
}

// Gestion de la soumission du formulaire
document.getElementById('appointment-form-content').addEventListener('submit', function (event) {
  event.preventDefault();
  alert('Rendez-vous confirmé ! Merci.');
});
</script>
  <!-- Pied de page -->



</body>
</html>