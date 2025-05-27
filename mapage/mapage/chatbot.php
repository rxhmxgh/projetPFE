-- Base de données: chatbot.sql --
-- Table: questions
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    reponse TEXT NOT NULL
);


<?php
$pdo = new PDO("mysql:host=localhost;dbname=chatbot", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = $pdo->query("SELECT * FROM questions");
$questions = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <?php
$pdo = new PDO("mysql:host=localhost;dbname=chatbot", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = $pdo->query("SELECT * FROM questions");
$questions = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .question {
            cursor: pointer;
            padding: 10px;
            border: 1px solid #ccc;
            margin: 5px 0;
            background-color: #e3f2fd;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .question:hover {
            background-color: #bbdefb;
        }
        .reponse {
            display: none;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 5px;
            margin-top: 5px;
        }
    </style>
    <script>
        function showReponse(id) {
            var reponse = document.getElementById("reponse-" + id);
            reponse.style.display = reponse.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>
    <h2>Chatbot - Questions Fréquentes</h2>
    <?php foreach ($questions as $q) : ?>
        <div class="question" onclick="showReponse(<?= $q['id'] ?>)">
            <?= htmlspecialchars($q['question']) ?>
        </div>
        <div class="reponse" id="reponse-<?= $q['id'] ?>">
            <?= htmlspecialchars($q['reponse']) ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
