<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crédits Auto Facilités | BADR LINE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0f2d0f;
            --secondary-color: #43a047;
            --accent-color: #ffc107;
            --danger-color: #e74c3c;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        

.contenu {
    margin: 70px  1px;
    min-height: 100vh;

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


        .header {
            background: linear-gradient(135deg, var(--primary-color), #1a3d1a);
            color: white;
            padding: 80px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://www.fiat.fr/content/dam/fiat/com/models/500x/500x-gallery-01.jpg') center/cover;
            opacity: 0.15;
            z-index: 0;
        }
        
        .header-content {
            position: relative;
            z-index: 1;
        }
        
        .header h1 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 2.8rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        
        .header p {
            font-size: 1.4rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        
        .countdown {
            background-color: rgba(255,255,255,0.2);
            display: inline-block;
            padding: 15px 30px;
            border-radius: 50px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .countdown span {
            color: var(--accent-color);
            font-weight: 700;
        }
        
        .offer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .models-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .car-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s;
            position: relative;
        }
        
        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .car-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .car-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--accent-color);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            z-index: 2;
        }
        
        .car-details {
            padding: 20px;
        }
        
        .car-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.5rem;
        }
        
        .car-type {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .car-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 1.2rem;
            margin-right: 10px;
        }
        
        .discount-badge {
            background-color: var(--danger-color);
            color: white;
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .offer-details {
            background-color: #f0f7f0;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .detail-value {
            font-weight: 700;
        }
        
        .monthly-payment {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-top: 15px;
        }
        
        .monthly-amount {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 8px 0;
        }
        
        .bank-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .bank-logo img {
            max-height: 80px;
        }
        
        .section-title {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            position: relative;
            font-size: 2.2rem;
        }
        
        .section-title:after {
            content: "";
            display: block;
            width: 120px;
            height: 4px;
            background: var(--accent-color);
            margin: 20px auto 0;
        }
        
        .footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 50px 0;
            margin-top: 50px;
        }
        
        .advantages-container {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            margin: 60px auto;
            max-width: 1100px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }
        
        .advantage-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .advantage-icon {
            background-color: var(--accent-color);
            color: var(--primary-color);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .advantage-text h3 {
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 1.3rem;
        }
        
        .btn-details {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.3s;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-details:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-cta {
            background-color: var(--danger-color);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            display: inline-block;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-cta:hover {
            background-color: #c0392b;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            padding: 20px;
        }
        
        .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .specs-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .specs-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .specs-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .specs-table td:first-child {
            font-weight: 600;
            color: var(--primary-color);
            width: 40%;
        }
        
        .special-offer {
            position: absolute;
            top: 15px;
            left: -35px;
            background-color: var(--danger-color);
            color: white;
            padding: 5px 40px;
            transform: rotate(-45deg);
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        .testimonial {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            position: relative;
        }
        
        .testimonial::before {
    content: "\""; /* Utilisation de l'échappement pour le guillemet */
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 60px;
    color: rgba(0,0,0,0.05);
    font-family: serif;
    line-height: 1;
}
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            font-size: 1.05rem;
        }
        
        .testimonial-author {
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .testimonial-author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .stats-container {
            background: linear-gradient(135deg, var(--primary-color), #1a3d1a);
            color: white;
            padding: 60px 0;
            margin: 60px 0;
            text-align: center;
        }
        
        .stat-item {
            padding: 0 20px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--accent-color);
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        
        .comparison-table th, .comparison-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .comparison-table th {
            background-color: var(--primary-color);
            color: white;
        }
        
        .comparison-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .comparison-table tr:hover {
            background-color: #f0f7f0;
        }
        
        .promo-banner {
            background-color: var(--accent-color);
            color: var(--primary-color);
            padding: 15px 0;
            text-align: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
        
        .promo-banner i {
            margin-right: 10px;
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin: 40px 0;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        @media (max-width: 768px) {
            .models-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                padding: 60px 0 40px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .advantage-item {
                flex-direction: column;
                text-align: center;
            }
            
            .advantage-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
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




  <!-- partie principal -->
<div class="contenu">

    <div class="promo-banner">
        <i class="fas fa-gift"></i> OFFRE EXCEPTIONNELLE : Assurance gratuite pendant 1 an pour tout crédit souscrit avant le 31/12/2025
    </div>
    
    <div class="header">
        <div class="header-content">

            <h1>CRÉDIT AUTO 0% FRAIS DE DOSSIER</h1>
            <p>Conduisez la voiture de vos rêves avec des mensualités adaptées à votre budget</p>
            
            <div class="countdown">
                Offre valable encore : <span id="countdown-timer">05j 12h 34m</span>
            </div>
            
            <a href="#models" class="btn-cta">
                <i class="fas fa-car me-2"></i> Voir nos offres
            </a>
        </div>
    </div>
    
    <div class="offer-container" id="models">
        <h2 class="section-title">NOS MODÈLES FIAT EN PROMOTION</h2>
        
        <div class="row">
            <div class="col-md-10 mx-auto text-center mb-5">
                <p class="lead">Profitez de nos offres exceptionnelles avec <strong>0% de frais de dossier</strong>, des taux préférentiels et des conditions de paiement flexibles. Tous nos prix sont en dinars algériens avec une garantie de prix bas.</p>
            </div>
        </div>
        
        <div class="models-grid">
            <!-- Fiat 500 -->
            <div class="car-card">
                <div class="special-offer">-15%</div>
                <div class="car-image" style="background-image: url('fiat500.jpg');">
                    <span class="car-badge">BEST-SELLER</span>
                </div>
                <div class="car-details">
                    <h3 class="car-title">Fiat 500 Hybrid</h3>
                    <div class="car-type">Citadine Élégante</div>
                    <div>
                        <span class="old-price">4 050 000 DA</span>
                        <span class="car-price">3 450 000 DA</span>
                        <span class="discount-badge">Économisez 600 000 DA</span>
                    </div>
                    
                    <div class="offer-details">
                        <div class="detail-item">
                            <span class="detail-label">Premier dépôt</span>
                            <span class="detail-value">1 700 000 DA</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durée</span>
                            <span class="detail-value">60 mois</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Taux</span>
                            <span class="detail-value">3.9% fixe</span>
                        </div>
                    </div>
                    
                    <div class="monthly-payment">
                        <div>Mensualité à partir de</div>
                        <div class="monthly-amount">31 500 DA/mois</div>
                    </div>
                    
                    <button class="btn-details" data-bs-toggle="modal" data-bs-target="#fiat500Modal">
                        <i class="fas fa-info-circle me-2"></i>Voir fiche technique
                    </button>
                </div>
            </div>
            
            <!-- Fiat Tipo -->
            <div class="car-card">
               <div class="car-image" style="background-image: url('fiattipo.png');">
                    <span class="car-badge">NOUVEAU</span>
                </div>
                <div class="car-details">
                    <h3 class="car-title">Fiat Tipo</h3>
                    <div class="car-type">Berline Compacte</div>
                    <div class="car-price">4 350 000 DA</div>
                    
                    <div class="offer-details">
                        <div class="detail-item">
                            <span class="detail-label">Premier dépôt</span>
                            <span class="detail-value">2 150 000 DA</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durée</span>
                            <span class="detail-value">60 mois</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Taux</span>
                            <span class="detail-value">4.1% fixe</span>
                        </div>
                    </div>
                    
                    <div class="monthly-payment">
                        <div>Mensualité à partir de</div>
                        <div class="monthly-amount">40 800 DA/mois</div>
                    </div>
                    
                    <button class="btn-details" data-bs-toggle="modal" data-bs-target="#tipoModal">
                        <i class="fas fa-info-circle me-2"></i>Voir fiche technique
                    </button>
                </div>
            </div>
            
            <!-- Fiat 500X -->
            <div class="car-card">
                <div class="special-offer">OFFRE FLASH</div>
               <div class="car-image" style="background-image: url('fiat500x.jpg');">
                    <span class="car-badge">SUV URBAIN</span>
                </div>
                <div class="car-details">
                    <h3 class="car-title">Fiat 500X</h3>
                    <div class="car-type">SUV Compact</div>
                    <div>
                        <span class="old-price">4 950 000 DA</span>
                        <span class="car-price">4 250 000 DA</span>
                        <span class="discount-badge">Économisez 700 000 DA</span>
                    </div>
                    
                    <div class="offer-details">
                        <div class="detail-item">
                            <span class="detail-label">Premier dépôt</span>
                            <span class="detail-value">2 100 000 DA</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durée</span>
                            <span class="detail-value">60 mois</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Taux</span>
                            <span class="detail-value">4.0% fixe</span>
                        </div>
                    </div>
                    
                    <div class="monthly-payment">
                        <div>Mensualité à partir de</div>
                        <div class="monthly-amount">39 200 DA/mois</div>
                    </div>
                    
                    <button class="btn-details" data-bs-toggle="modal" data-bs-target="#500xModal">
                        <i class="fas fa-info-circle me-2"></i>Voir fiche technique
                    </button>
                </div>
            </div>
            
            <!-- Fiat Doblo Commercial -->
            <div class="car-card">
                    <div class="car-image" style="background-image: url('fiatdoblotourisqtique.jpg');">
                    <span class="car-badge">UTILITAIRE</span>
                </div>
                <div class="car-details">
                    <h3 class="car-title">Fiat Doblo Commercial</h3>
                    <div class="car-type">Utilitaire Polyvalent</div>
                    <div class="car-price">3 880 000 DA</div>
                    
                    <div class="offer-details">
                        <div class="detail-item">
                            <span class="detail-label">Premier dépôt</span>
                            <span class="detail-value">1 900 000 DA</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durée</span>
                            <span class="detail-value">60 mois</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Taux</span>
                            <span class="detail-value">4.2% fixe</span>
                        </div>
                    </div>
                    
                    <div class="monthly-payment">
                        <div>Mensualité à partir de</div>
                        <div class="monthly-amount">36 400 DA/mois</div>
                    </div>
                    
                    <button class="btn-details" data-bs-toggle="modal" data-bs-target="#dobloCommercialModal">
                        <i class="fas fa-info-circle me-2"></i>Voir fiche technique
                    </button>
                </div>
            </div>
            
            <!-- Fiat Doblo Touristique -->
            <div class="car-card">
             <div class="car-image" style="background-image: url('fiatdoblo.png');">
                    <span class="car-badge">FAMILIAL</span>
                </div>
                <div class="car-details">
                    <h3 class="car-title">Fiat Doblo Touristique</h3>
                    <div class="car-type">Monospace Familial</div>
                    <div class="car-price">4 190 000 DA</div>
                    
                    <div class="offer-details">
                        <div class="detail-item">
                            <span class="detail-label">Premier dépôt</span>
                            <span class="detail-value">2 050 000 DA</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durée</span>
                            <span class="detail-value">60 mois</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Taux</span>
                            <span class="detail-value">4.0% fixe</span>
                        </div>
                    </div>
                    
                    <div class="monthly-payment">
                        <div>Mensualité à partir de</div>
                        <div class="monthly-amount">39 500 DA/mois</div>
                    </div>
                    
                    <button class="btn-details" data-bs-toggle="modal" data-bs-target="#dobloTouristiqueModal">
                        <i class="fas fa-info-circle me-2"></i>Voir fiche technique
                    </button>
                </div>
            </div>
            
            <!-- Fiat Panda -->
            <div class="car-card">
                <div class="car-image" style="background-image: url('fiatpanda.jpg');">
                    <span class="car-badge">ÉCONOMIQUE</span>
                </div>
                <div class="car-details">
                    <h3 class="car-title">Fiat Panda</h3>
                    <div class="car-type">Citadine Pratique</div>
                    <div class="car-price">2 920 000 DA</div>
                    
                    <div class="offer-details">
                        <div class="detail-item">
                            <span class="detail-label">Premier dépôt</span>
                            <span class="detail-value">1 420 000 DA</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durée</span>
                            <span class="detail-value">60 mois</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Taux</span>
                            <span class="detail-value">3.7% fixe</span>
                        </div>
                    </div>
                    
                    <div class="monthly-payment">
                        <div>Mensualité à partir de</div>
                        <div class="monthly-amount">26 900 DA/mois</div>
                    </div>
                    
                    <button class="btn-details" data-bs-toggle="modal" data-bs-target="#pandaModal">
                        <i class="fas fa-info-circle me-2"></i>Voir fiche technique
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="stats-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">15 000+</div>
                        <div class="stat-label">Clients satisfaits</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Taux de satisfaction</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">48h</div>
                        <div class="stat-label">Délai moyen de réponse</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">0 DA</div>
                        <div class="stat-label">Frais de dossier</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="advantages-container">
        <h2 class="section-title">Pourquoi choisir BADR LINE ?</h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="advantage-text">
                        <h3>Taux compétitifs</h3>
                        <p>Les meilleurs taux du marché avec des conditions avantageuses et négociables selon votre profil.</p>
                    </div>
                </div>
                
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="advantage-text">
                        <h3>Décision rapide</h3>
                        <p>Réponse sous 48h pour votre demande de crédit avec un processus simplifié et digitalisé.</p>
                    </div>
                </div>
                
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="advantage-text">
                        <h3>Assurance incluse</h3>
                        <p>1 an d'assurance tous risques offert pour tout crédit souscrit avant fin d'année.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="advantage-text">
                        <h3>Premier dépôt réduit</h3>
                        <p>Jusqu'à 50% du prix du véhicule seulement pour démarrer votre projet.</p>
                    </div>
                </div>
                
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="advantage-text">
                        <h3>Conseiller dédié</h3>
                        <p>Un conseiller personnel disponible pour vous accompagner à chaque étape.</p>
                    </div>
                </div>
                
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="advantage-text">
                        <h3>Rachat de crédit</h3>
                        <p>Possibilité de regrouper vos crédits existants pour un meilleur taux.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="#contact" class="btn-cta">
                <i class="fas fa-phone-alt me-2"></i> Être rappelé par un conseiller
            </a>
        </div>
    </div>
    
    <div class="offer-container">
        <h2 class="section-title">Comparatif des modèles</h2>
        
        <div class="table-responsive">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Modèle</th>
                        <th>Prix</th>
                        <th>Mensualité (60 mois)</th>
                        <th>Type</th>
                        <th>Consommation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fiat 500 Hybrid</td>
                        <td>3 450 000 DA</td>
                        <td>31 500 DA</td>
                        <td>Citadine</td>
                        <td>4.1L/100km</td>
                    </tr>
                    <tr>
                        <td>Fiat Tipo</td>
                        <td>4 350 000 DA</td>
                        <td>40 800 DA</td>
                        <td>Berline</td>
                        <td>5.2L/100km</td>
                    </tr>
                    <tr>
                        <td>Fiat 500X</td>
                        <td>4 250 000 DA</td>
                        <td>39 200 DA</td>
                        <td>SUV</td>
                        <td>5.8L/100km</td>
                    </tr>
                    <tr>
                        <td>Fiat Doblo Commercial</td>
                        <td>3 880 000 DA</td>
                        <td>36 400 DA</td>
                        <td>Utilitaire</td>
                        <td>5.3L/100km</td>
                    </tr>
                    <tr>
                        <td>Fiat Doblo Touristique</td>
                        <td>4 190 000 DA</td>
                        <td>39 500 DA</td>
                        <td>Monospace</td>
                        <td>5.5L/100km</td>
                    </tr>
                    <tr>
                        <td>Fiat Panda</td>
                        <td>2 920 000 DA</td>
                        <td>26 900 DA</td>
                        <td>Citadine</td>
                        <td>4.8L/100km</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="offer-container">
        <h2 class="section-title">Ils nous ont fait confiance</h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial">
                    <div class="testimonial-text">
                        "J'ai obtenu mon crédit pour une Fiat 500 en moins de 48h. Les mensualités sont parfaitement adaptées à mon budget et le service client est réactif."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Karim B.">
                        <div>
                            <div>Karim B.</div>
                            <div class="text-muted small">Alger</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="testimonial">
                    <div class="testimonial-text">
                        "Le Doblo Commercial est parfait pour mon activité. BADR LINE m'a offert des conditions très avantageuses avec un premier dépôt réduit."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Samira T.">
                        <div>
                            <div>Samira T.</div>
                            <div class="text-muted small">Oran</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="testimonial">
                    <div class="testimonial-text">
                        "Service client exceptionnel. Ils ont tout fait pour que je puisse obtenir le véhicule dont je rêvais malgré mon profil de jeune actif."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Mohamed L.">
                        <div>
                            <div>Mohamed L.</div>
                            <div class="text-muted small">Constantine</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Modals pour les fiches techniques -->
    <!-- Fiat 500 Modal -->
    <div class="modal fade" id="fiat500Modal" tabindex="-1" aria-labelledby="fiat500ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fiat500ModalLabel">Fiche technique - Fiat 500 Hybrid</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="fiat500.jpg" class="img-fluid rounded mb-3" alt="Fiat 500">
                            <div class="alert alert-info">
                                <i class="fas fa-gift me-2"></i> Offre spéciale : Assurance 1 an offerte
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Prix: 3 450 000 DA</h4>
                            <p class="text-muted">Citadine hybride élégante et économique</p>
                            
                            <table class="specs-table">
                                <tr>
                                    <td>Moteur</td>
                                    <td>1.0 FireFly Hybrid 70ch</td>
                                </tr>
                                <tr>
                                    <td>Consommation mixte</td>
                                    <td>4.1L/100km</td>
                                </tr>
                                <tr>
                                    <td>Puissance</td>
                                    <td>70 ch</td>
                                </tr>
                                <tr>
                                    <td>Boîte de vitesses</td>
                                    <td>Manuelle 6 rapports</td>
                                </tr>
                                <tr>
                                    <td>Nombre de places</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>Coffre</td>
                                    <td>185 litres</td>
                                </tr>
                                <tr>
                                    <td>Longueur</td>
                                    <td>3.63 m</td>
                                </tr>
                                <tr>
                                    <td>Émissions CO2</td>
                                    <td>92 g/km</td>
                                </tr>
                                <tr>
                                    <td>Garantie</td>
                                    <td>3 ans / 100 000 km</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Équipements principaux :</h5>
                            <ul class="row">
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Climatisation</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Système audio Bluetooth</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Volant multifonction</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Vitres électriques</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> ABS + ESP</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> 6 airbags</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
               
                </div>
            </div>
        </div>
    </div>
    
    <!-- Fiat Tipo Modal -->
    <div class="modal fade" id="tipoModal" tabindex="-1" aria-labelledby="tipoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tipoModalLabel">Fiche technique - Fiat Tipo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="fiattipo.png" class="img-fluid rounded mb-3" alt="Fiat Tipo">
                            <div class="alert alert-info">
                                <i class="fas fa-gift me-2"></i> Offre spéciale : Entretien 2 ans offert
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Prix: 4 350 000 DA</h4>
                            <p class="text-muted">Berline compacte spacieuse et moderne</p>
                            
                            <table class="specs-table">
                                <tr>
                                    <td>Moteur</td>
                                    <td>1.4 T-Jet 120ch</td>
                                </tr>
                                <tr>
                                    <td>Consommation mixte</td>
                                    <td>5.2L/100km</td>
                                </tr>
                                <tr>
                                    <td>Puissance</td>
                                    <td>120 ch</td>
                                </tr>
                                <tr>
                                    <td>Boîte de vitesses</td>
                                    <td>Manuelle 6 rapports</td>
                                </tr>
                                <tr>
                                    <td>Nombre de places</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Coffre</td>
                                    <td>440 litres</td>
                                </tr>
                                <tr>
                                    <td>Longueur</td>
                                    <td>4.37 m</td>
                                </tr>
                                <tr>
                                    <td>Émissions CO2</td>
                                    <td>119 g/km</td>
                                </tr>
                                <tr>
                                    <td>Garantie</td>
                                    <td>3 ans / 100 000 km</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Équipements principaux :</h5>
                            <ul class="row">
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Climatisation automatique</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Écran tactile 7"</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Volant cuir multifonction</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Vitres électriques</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Radar de recul</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> 6 airbags</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              
                </div>
            </div>
        </div>
    </div>
    
    <!-- Fiat 500X Modal -->
    <div class="modal fade" id="500xModal" tabindex="-1" aria-labelledby="500xModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="500xModalLabel">Fiche technique - Fiat 500X</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="fiat500x.jpg" class="img-fluid rounded mb-3" alt="Fiat 500X">
                            <div class="alert alert-info">
                                <i class="fas fa-gift me-2"></i> Offre spéciale : Pack hiver offert
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Prix: 4 250 000 DA</h4>
                            <p class="text-muted">SUV urbain stylé et performant</p>
                            
                            <table class="specs-table">
                                <tr>
                                    <td>Moteur</td>
                                    <td>1.3 FireFly Turbo 150ch</td>
                                </tr>
                                <tr>
                                    <td>Consommation mixte</td>
                                    <td>5.8L/100km</td>
                                </tr>
                                <tr>
                                    <td>Puissance</td>
                                    <td>150 ch</td>
                                </tr>
                                <tr>
                                    <td>Boîte de vitesses</td>
                                    <td>Automatique 6 rapports</td>
                                </tr>
                                <tr>
                                    <td>Nombre de places</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Coffre</td>
                                    <td>350 litres</td>
                                </tr>
                                <tr>
                                    <td>Longueur</td>
                                    <td>4.25 m</td>
                                </tr>
                                <tr>
                                    <td>Émissions CO2</td>
                                    <td>132 g/km</td>
                                </tr>
                                <tr>
                                    <td>Garantie</td>
                                    <td>3 ans / 100 000 km</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Équipements principaux :</h5>
                            <ul class="row">
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Climatisation automatique bi-zone</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Écran tactile 8.4"</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Volant cuir chauffant</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Toit panoramique</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> Aide au maintien de voie</li>
                                <li class="col-md-4"><i class="fas fa-check text-success me-2"></i> 7 airbags</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- Autres modals (Doblo Commercial, Doblo Touristique, Panda) -->
    <!-- ... (similaires aux modals précédents) ... -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Compte à rebours
        function updateCountdown() {
            const endDate = new Date("2023-12-31T23:59:59");
            const now = new Date();
            const diff = endDate - now;
            
            if (diff <= 0) {
                document.getElementById("countdown-timer").textContent = "Offre expirée";
                return;
            }
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            
            document.getElementById("countdown-timer").textContent = 
                `${days}j ${hours}h ${minutes}m`;
        }
        
        setInterval(updateCountdown, 60000);
        updateCountdown();
        
        // Animation pour les cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.car-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease ' + (index * 0.1) + 's';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        });
        
        // Effet de survol pour les boutons
        const buttons = document.querySelectorAll('.btn-details, .btn-cta');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>