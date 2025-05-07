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
        body { font-family: Arial; background: #eef2f5; padding: 20px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        .question { border-bottom: 1px solid #ccc; padding: 10px 0; }
        form { display: flex; flex-direction: column; gap: 5px; margin-top: 5px; }
        textarea { resize: none; padding: 5px; }
        button { width: fit-content; background: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 4px; }
        .answered { color: green; font-style: italic; }
    </style>
</head>
<body>
<div class="container">
    <h2>👤 Interface Admin - Réponses</h2>
    <?php while ($row = $questions->fetch_assoc()): ?>
        <div class="question">
            <p><strong>Client :</strong> <?= htmlspecialchars($row['user_question']) ?></p>
            <?php if ($row['admin_response']): ?>
                <p class="answered">✅ Réponse : <?= htmlspecialchars($row['admin_response']) ?></p>
            <?php else: ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <textarea name="response" rows="2" cols="60" placeholder="Votre réponse..." required></textarea>
                    <button type="submit">Répondre</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
