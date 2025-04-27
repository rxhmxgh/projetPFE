<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: seconnecter.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recharge Mobile</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f0f0;
            padding: 50px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 25px;
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-size: 0.9em;
        }
    </style>
    <script>
        function validateForm() {
            const operateur = document.getElementById("operateur").value;
            const numero = document.getElementById("numero").value.trim();
            const erreur = document.getElementById("erreur");

            let regex;

            if (operateur === "Ooredoo") {
                regex = /^05\d{8}$/;
            } else if (operateur === "Mobilis") {
                regex = /^06\d{8}$/;
            } else if (operateur === "Djezzy") {
                regex = /^07\d{8}$/;
            }

            if (!regex.test(numero)) {
                erreur.textContent = "Le numéro doit commencer par " + regex.source.slice(1, 3) + " et comporter 10 chiffres.";
                return false;
            }

            erreur.textContent = "";
            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Recharge Mobile</h2>
    <form action="traitement_recharge.php" method="post" onsubmit="return validateForm();">
        <label for="operateur">Opérateur :</label>
        <select name="operateur" id="operateur" required>
            <option value="">-- Choisir --</option>
            <option value="Ooredoo">Ooredoo</option>
            <option value="Djezzy">Djezzy</option>
            <option value="Mobilis">Mobilis</option>
        </select>

        <label for="numero">Numéro de téléphone :</label>
        <input type="text" name="numero" id="numero" maxlength="10" placeholder="Ex: 0771234567" required>

        <label for="montant">Montant (DA) :</label>
        <input type="number" name="montant" id="montant" min="50" step="10" required>

        <div id="erreur" class="error"></div>

        <button type="submit">Valider la Recharge</button>
    </form>
</div>

</body>
</html>
