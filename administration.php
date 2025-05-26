
<style>
/* Reset simple */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 20px;
    color: #2c3e50;
}
nav {
        background-color: #333;
       background-color: #333;
  padding: 10px 20px;
    }
    
   nav ul {
  list-style: none;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin: 0;
  padding: 0;
  flex-wrap: wrap; /* Pour s'adapter sur petits écrans */
}
    
    nav ul li {
        display: inline-block;
      
    }
    
    nav ul li a {
        color: white;
        text-decoration: none;
        font-size: 18px;
       transition: color 0.3s ease;
    }
    
    nav ul li a:hover {
        text-decoration: underline;
          color: #b0e57c;
    }


/* Contenu principal */
.content {
  padding: 30px;
  background-color: #f4f4f4;
  min-height: 100vh;
  
  /* Centrage horizontal et vertical */
  display: flex;
  justify-content: center;
  align-items: center;
  
  flex-direction: column;  /* Facultatif : permet de gérer la disposition des éléments enfants */
}

/* Cartes et sections */
.card {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  max-width: 900px;
  width: 100%;
  margin: 0 auto;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2, h3 {
  color: #34495e;
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
  background-color:rgb(183, 230, 192);
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
    transition: background-color 0.3s ease;
}

.btn-primary {
  background-color:rgb(52, 125, 34);
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
/* stype pour tableau organisé */
/* Responsive Table */
.table-responsive {
  width: 100%;
  overflow-x: auto;
}

table {
  min-width: 600px; /* ou plus, selon ton contenu */
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 12px;
  text-align: center;
  border: 1px solid #ccc;
  white-space: nowrap; /* évite le retour à la ligne dans les cellules */
}

th {
  background-color: rgb(52, 125, 34);
  color: white;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
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
  color: #34495e;
}

/* Organisation du formulaire client */
form .row {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

form .row > div {
  flex: 1 1 calc(50% - 20px); /* Deux colonnes responsives */
  min-width: 250px;
}

/* Espacement du bouton Ajouter */
form button[type="submit"] {
  margin-top: 15px;
  display: block;
}

/* Boutons dans le tableau */
table td:last-child {
  white-space: nowrap;
}

.btn-sm {
  margin-right: 6px;
  min-width: 80px;
  text-align: center;
}

/* Responsive mobile */
@media (max-width: 600px) {
  form .row > div {
    flex: 1 1 100%;
  }

  .btn-sm {
    display: block;
    margin: 5px auto;
    width: 100%;
  }
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
        <li><a href="administration.php">Gestion des clients</a></li>
         <li><a href="admin_message.php">Gestion des messages</a></li>
          <li><a href="chatbot_admin.php">Les messages du chatbot</a></li>
        <li><a href="logout.php">Déconnecter</a></li>
      
    </ul>
</nav>


<!-- Partie principale -->
<div class="content">
    <section id="clients" class="clients-section py-5">
        <div class="container">
            <div class="card shadow-lg p-4 mx-auto" style="max-width: 1000px;">
                <h2 class="text-center mb-4">Gestion des Clients</h2>

                <!-- Ajouter un client -->
                <form method="POST" action="">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="telephone" class="form-label">Téléphone</label>
      <input type="tel" class="form-control" id="telephone" name="telephone" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="ccp" class="form-label">Numéro RIB</label>
      <input type="text" class="form-control" id="ccp" name="ccp" required>
    </div>
  </div>
  <button type="submit" name="ajouter_client" class="btn btn-primary">Ajouter</button>
</form>


                <!-- Tableau des clients -->
<h3 class="text-center mb-4">Liste des clients</h3>
<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>RIB</th>
            <th>Actions</th> <!-- Ajouté -->
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
                    <td>{$client['ccp']}</td>
                    <td>
                        <div style='display: flex; justify-content: center; gap: 10px;'>
                            <a href='modifier_client.php?id={$client['id']}' class='btn btn-warning btn-sm'>Modifier</a>
                            <a href='supprimer_client.php?id={$client['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\");'>Supprimer</a>
                        </div>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
</div>
            </div>
        </div>
    </section>
</div>

<!-- Partie PHP pour gestion admin -->
<?php


$pdo = new PDO("mysql:host=localhost;dbname=BanqueModerne;charset=utf8", "root", "");

if (isset($_POST['ajouter_client'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $ccp = htmlspecialchars($_POST['ccp']);

    try {
        // Vérifier si le CCP existe déjà
        $check = $pdo->prepare("SELECT * FROM utilisateurs WHERE ccp = :ccp");
        $check->execute(['ccp' => $ccp]);

        if ($check->rowCount() > 0) {
            echo "<script>alert('⚠️ Ce numéro RIB existe déjà !');</script>";
        } else {
            $sql = "INSERT INTO utilisateurs (nom, prenom, email, telephone, ccp) 
                    VALUES (:nom, :prenom, :email, :telephone, :ccp)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'telephone' => $telephone,
                'ccp' => $ccp
            ]);

            echo "<script>alert('✅ Client ajouté avec succès !'); window.location.reload();</script>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

</body>
</html>
