<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Prise de rendez-vous - Banque</title>
   <!-- Bootstrap JS Bundle (inclut Popper.js) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.card {
  border: none;
  background-color: #ffffff;
  border-left: 6px solid orange;
}

.btn-success {
  background-color: #28a745;
  border-color: #28a745;
}

.btn-success:hover {
  background-color: #218838;
}

</style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow-lg p-4 rounded-4">
      <h2 class="text-center text-success mb-4">Prise de rendez-vous</h2>

      <form id="appointmentForm" action="confirmation.php" method="POST">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Nom complet</label>
            <input type="text" name="nom" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required />
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Numéro de téléphone</label>
            <input type="tel" name="telephone" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Type de rendez-vous</label>
            <select name="type" class="form-select" required>
              <option value="">Choisir...</option>
              <option>Ouverture de compte</option>
              <option>Demande de prêt</option>
              <option>Conseil financier</option>
              <option>Service client</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Heure</label>
            <input type="time" name="heure" class="form-control" required />
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-success px-5 py-2">Confirmer</button>
        </div>
      </form>
    </div>
  </div>
<!-- partie JS -->
  <script>
    document.getElementById('appointmentForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const form = this;
  const formData = new FormData(form);

  fetch(form.getAttribute('action'),  {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(response => {
    if (response === 'success') {
      alert("✅ Rendez-vous confirmé avec succès !");
      form.reset();
    } else {
      alert("❌ Une erreur est survenue : " + response);
    }
  });
});

  </script>

<!-- php -->
<?php
$host = 'localhost';
$dbname = 'banquemoderne';
$user = 'root';
$pass = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
?>

</body>
</html>
