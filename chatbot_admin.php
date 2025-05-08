<?php
// chatbot_admin.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "banquemoderne";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Erreur : " . $conn->connect_error);

// Traitement d'une réponse
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['response'])) {
    $id = (int) $_POST['id'];
    $resp = $conn->real_escape_string($_POST['response']);
    $conn->query("UPDATE questions SET admin_response = '$resp' WHERE id = $id");
    header("Location: chatbot_admin.php");
    exit();
}

// Récupération des questions
$questions = $conn->query("SELECT * FROM questions ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Chatbot BADR LINE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f4f7;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .message-block {
            margin-bottom: 20px;
            padding: 10px;
        }

        .bubble {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 20px;
            margin: 5px 0;
            display: inline-block;
            position: relative;
            font-size: 14px;
        }

        .client {
            background-color: #e0f0ff;
            color: #000;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }

        .admin {
            background-color: #d4edda;
            color: #000;
            align-self: flex-end;
            border-bottom-right-radius: 0;
            float: right;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        form {
            margin-top: 10px;
        }

        textarea {
            width: 100%;
            resize: none;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }

        button {
            margin-top: 8px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
        padding: 10px;
        text-align: center;
    }
    
    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    
    nav ul li {
        display: inline;
        margin-right: 20px;
    }
    
    nav ul li a {
        color: white;
        text-decoration: none;
        font-size: 18px;
    }
    
    nav ul li a:hover {
        text-decoration: underline;
    }

    .content {
            background-color: rgba(255, 248, 248, 0.46);;
    padding: 50px 20px;
    min-height: 10vh;
    display: flex;
    flex-direction: column;

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
        <li><a href="chatbot_admin.php">Les messages</a></li>
        <li><a href="logout.php">Déconnecter</a></li>

    </ul>
</nav>
<div class="content" >
<div class="container">
    <h2>🤖 Réponses aux Clients - Admin Chat</h2>

    <?php while ($row = $questions->fetch_assoc()): ?>
        <div class="message-block">
            <div class="bubble client clearfix">
                👤 <?= htmlspecialchars($row['user_question']) ?>
            </div>

            <?php if ($row['admin_response']): ?>
                <div class="bubble admin clearfix">
                    ✅ <?= htmlspecialchars($row['admin_response']) ?>
                </div>
            <?php else: ?>
                <form method="POST" class="clearfix">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <textarea name="response" rows="2" placeholder="Répondre ici..." required></textarea>
                    <button type="submit">Répondre</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>
</div>
</body>
</html>
