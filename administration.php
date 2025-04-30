<style>
/* Reset simple */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

/* Navigation */
nav {
  background-color: #004080;
  padding: 10px 20px;
}

nav ul {
  list-style: none;
  display: flex;
  justify-content: flex-start;
  gap: 20px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}

nav ul li a:hover {
  text-decoration: underline;
}

/* Contenu principal */
.content {
  padding: 30px;
  background-color: #f4f4f4;
  min-height: 100vh;
}

/* Cartes et sections */
.card {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
}

h2, h3 {
  color: #004080;
  text-align: center;
}

/* Table des clients */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 12px;
  text-align: center;
  border: 1px solid #ccc;
}

th {
  background-color: #007acc;
  color: white;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

/* Boutons */
.btn {
  padding: 6px 12px;
  border: none;
  border-radius: 5px;
  color: white;
  cursor: pointer;
  font-size: 14px;
}

.btn-primary {
  background-color: #007acc;
}

.btn-warning {
  background-color: #f0ad4e;
}

.btn-danger {
  background-color: #d9534f;
}

.btn-sm {
  padding: 5px 10px;
  font-size: 13px;
}

/* Formulaires */
input[type="text"], input[type="email"], input[type="tel"] {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

fieldset {
  border: 1px solid #ccc;
  margin-bottom: 20px;
  padding: 15px;
  border-radius: 8px;
}

legend {
  font-weight: bold;
  padding: 0 10px;
  color: #004080;
}
</style>

</head>
<body>


    <!-- Menu de navigation -->
    <nav>
    <ul>
        <li><a href="admin_rendezvous.php">Rendez-vous</a></li>
        <li><a href="admin_demandeouvrircompteb.php">Compte bancaire</a></li>
        <li><a href="admin_demandes.php">Carte et Chèques</a></li>
        
    </ul>
</nav>

<!-- Partie principale -->
<div class="content">
    <section id="clients" class="clients-section py-5">
        <div class="container">
            <div class="card shadow-lg p-4 mx-auto" style="max-width: 1000px;">
                <h2 class="text-center mb-4">Gestion des Clients</h2>

                <!-- Ajouter un client -->
                <form method="POST" action="" class="mb-4">
                    <fieldset class="border p-3 mb-3 rounded">
                        <legend class="float-none w-auto px-3">Ajouter un nouveau client</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                            </div>
                            <!-- Ajoutez d'autres champs ici -->
                        </div>
                        <button type="submit" name="ajouter_client" class="btn btn-primary">Ajouter un client</button>
                    </fieldset>
                </form>

                <!-- Tableau des clients -->
                <h3 class="text-center mb-4">Liste des clients</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données
                        $pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");
                        $stmt = $pdo->query("SELECT * FROM utilisateurs");
                        while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                    <td>{$client['id']}</td>
                                    <td>{$client['nom']}</td>
                                    <td>{$client['prenom']}</td>
                                    <td>{$client['email']}</td>
                                    <td>{$client['telephone']}</td>
                                    <td>
                                        <a href='modifier_client.php?id={$client['id']}' class='btn btn-warning btn-sm'>Modifier</a>
                                        <a href='supprimer_client.php?id={$client['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\");'>Supprimer</a>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Partie PHP pour gestion admin -->
<?php
if (isset($_POST['ajouter_client'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    // Ajoutez d'autres champs ici...

    // Insérer un nouveau client
    $sql = "INSERT INTO utilisateurs (nom, prenom) VALUES (:nom, :prenom)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
    ]);
    echo "<script>alert('Client ajouté avec succès !'); window.location.reload();</script>";
}
?>
</body>
</html>
