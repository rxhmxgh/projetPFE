<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap JS Bundle (inclut Popper.js) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
      .body{
        font-family: 'Poppins', sans-serif;
      }
        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .active-step {
            background-color:green;
            color: white;
        }
        .wizard-step {
            text-align: center;
            margin-bottom: 2rem;
        }
        .btn-next {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="text-center mb-4">
    <h3>Mon Rendez-Vous</h3>
        <div class="d-flex justify-content-between wizard-step">
            <div>
                <div class="step-icon active-step">1</div>
                <p>Etape 1</p>
            </div>
            <div>
                <div class="step-icon">2</div>
                <p>Etape 2</p>
            </div>
            <div>
                <div class="step-icon">3</div>
                <p>Etape 3</p>
            </div>
            <div>
                <div class="step-icon">4</div>
                <p>Confirmation</p>
            </div>
        </div>
    </div>

    <form action="prendre_rdv.php" method="POST">
        <div class="mb-3">
            <label for="emplacement" class="form-label">Sélectionnez un emplacement *</label>
            <select class="form-select" name="emplacement" required>
                <option value="">-- Choisissez --</option>
                <option value="Agence Centrale">Agence Centrale</option>
                <option value="Agence Belouizdad">Agence Belouizdad</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="prestation" class="form-label">Sélectionnez une prestation *</label>
            <select class="form-select" name="prestation" required>
                <option value="">-- Choisissez --</option>
                <option value="Ouverture de compte">Ouverture de compte</option>
                <option value="Demande de crédit">Demande de crédit</option>
                <option value="Informations générales">Informations générales</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="representant" class="form-label">Sélectionnez un représentant</label>
            <select class="form-select" name="representant">
                <option value="">-- Indifférent --</option>
                <option value="Mme. Nadia">Mme. Nadia</option>
                <option value="M. Karim">M. Karim</option>
            </select>
        </div>

        <div class="text-end">
          <a href="etapes2.php" class="btn btn-next">Prochain</a>
        </div>
    </form>
</div>

</body>
</html>
