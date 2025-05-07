<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "banquemoderne";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Erreur : " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_question'])) {
    $q = $conn->real_escape_string($_POST['user_question']);
    $conn->query("INSERT INTO questions (user_question) VALUES ('$q')");
    header("Location: chatbot_user.php");
    exit();
}

$questions = $conn->query("SELECT user_question, admin_response FROM questions ORDER BY created_at ASC");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chatbot BADR LINE</title>
    <style>
        /* Styles principaux */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f6f1e7;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .chatbot-container {
            width: 400px;
            background: #d4e9d3;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: none; /* Chatbot caché par défaut */
            position: fixed;
            bottom: 100px;
            right: 30px;
            z-index: 1000;
            flex-direction: column;
        }

        .chat-header {
            background: #43a047;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .chat-body {
            background: white;
            padding: 15px;
            height: 300px;
            overflow-y: scroll;
        }

        .message {
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 80%;
        }

        .from-user {
            background: #e0e0e0;
            align-self: flex-start;
        }

        .from-admin {
            background: #c8e6c9;
            align-self: flex-end;
            text-align: right;
        }

        .chat-footer {
            background: #d9e8d9;
            padding: 10px;
        }

        .form-section {
            display: flex;
            gap: 5px;
            margin-bottom: 10px;
        }

        select, input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            background: #4CAF50;
            border: none;
            padding: 8px 12px;
            border-radius: 50%;
            cursor: pointer;
        }

        button img {
            width: 20px;
            height: 20px;
        }

        /* Icône flottante et tooltip */
        .chat-tooltip {
            position: fixed;
            bottom: 90px;
            right: 90px;
            background: #333;
            color: #fff;
            padding: 12px 20px;
            border-radius: 20px;
            font-size: 14px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            z-index: 999;
            animation: fadeIn 0.5s;
        }

        .chat-icon {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #4CAF50;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            transition: transform 0.2s;
        }

        .chat-icon:hover {
            transform: scale(1.1);
        }

        .chat-icon img {
            width: 30px;
            height: 30px;
        }

        /* Animation du message d'accueil */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<!-- ✅ Message d'accueil -->
<div class="chat-tooltip" id="chat-tooltip">
    Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?
</div>

<!-- ✅ Icône flottante pour ouvrir/fermer le chatbot -->
<div class="chat-icon" id="chat-icon">
    <img src="icon_chatbot.png" alt="Chat Icon" />
</div>

<!-- ✅ Fenêtre du chatbot (invisible au départ) -->
<div class="chatbot-container" id="chat-container">
    <div class="chat-header">Chatbot</div>
    <div class="chat-body" id="chat">
        <div class="message from-user">Bonjour 👋 ! Comment puis-je vous aider aujourd’hui ?</div>
        <?php while ($row = $questions->fetch_assoc()): ?>
            <div class="message from-user"><?= htmlspecialchars($row['user_question']) ?></div>
            <?php if ($row['admin_response']): ?>
                <div class="message from-admin"><?= htmlspecialchars($row['admin_response']) ?></div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <div class="chat-footer">
        <form method="POST" class="form-section">
            <select onchange="faqSelected(this)" id="faq">
                <option value="">Choisissez une question...</option>
                <option value="Comment ouvrir un compte ?">Comment ouvrir un compte ?</option>
                <option value="Quels documents sont nécessaires ?">Quels documents sont nécessaires ?</option>
                <option value="Comment demander un prêt ?">Comment demander un prêt ?</option>
                <option value="Quels sont vos horaires ?">Quels sont vos horaires ?</option>
            </select>
            <button type="button" onclick="sendFAQ()">
                <img src="send.png" alt="Envoyer">
            </button>
        </form>
        <p style="font-size: 12px; color: #333; margin: 5px;">Vous pouvez poser vos questions directement 👇</p>
        <form method="POST" class="form-section">
            
            <input type="text" name="user_question" placeholder="Votre question..." required>
            <button type="submit">
                <img src="send.png" alt="Envoyer">
            </button>
        </form>
        
    </div>
</div>

<script>
    // Disparition automatique du message d’accueil
    setTimeout(() => {
        document.getElementById("chat-tooltip").style.display = "none";
    }, 5000); // après 5 secondes

    // Ouvrir / fermer le chatbot
    document.getElementById("chat-icon").addEventListener("click", function() {
        let chatContainer = document.getElementById("chat-container");
        chatContainer.style.display = (chatContainer.style.display === "flex" || chatContainer.style.display === "block") ? "none" : "flex";
    });

    function faqSelected(select) {
        const value = select.value;
        if (value !== "") {
            document.querySelector('input[name="user_question"]').value = value;
        }
    }

    function sendFAQ() {
        const value = document.getElementById("faq").value;
        if (value !== "") {
            document.querySelector('input[name="user_question"]').value = value;
            document.querySelector('form:last-of-type').submit();
        }
    }
</script>

</body>
</html>
