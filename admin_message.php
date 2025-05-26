<?php


// Connexion à la base de données 'banquemoderne'
$host = "localhost";
$username = "root";
$password = "";
$dbname = "banquemoderne";

$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Messages - Admin</title>
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

h2 {
    text-align: center;
    color: #34495e;
    margin-bottom: 25px;
    font-size: 24px;
}

.container {
    max-width: 1200px;
    margin: auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px 16px;
    text-align: left;
}

th {
    background-color: #d5f0da;
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #bdc3c7;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #eef6f9;
}

a {
    color:#34495e;
    
}

a:hover {
    text-decoration: underline;
}

.button {
    background-color: #3498db;
    color: white;
    padding: 8px 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
}

.button:hover {
    background-color: #2980b9;
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
   <center><h1>Gestion des Messages</h1></center> 
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
<?php
// Vérification si des messages sont récupérés
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . nl2br($row["message"]) . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td><a href='supprimer_message.php?id=" . $row["id"] . "'>Supprimer</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucun message trouvé</td></tr>";
}
?>
    </table>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
