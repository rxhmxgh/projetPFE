<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=banquemoderne", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_POST['verified_ids'])) {
        $verified_ids = $_POST['verified_ids'];

        foreach ($verified_ids as $id) {
            $stmt = $db->prepare("UPDATE demandes_compte SET is_verified = 1 WHERE id = ?");
            $stmt->execute([$id]);
        }

        header("Location: admin_demandeouvrircompteb.php");
        exit;
    } else {
        echo "Aucune demande n'a été sélectionnée pour être vérifiée.";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion ou de requête SQL: " . $e->getMessage();
}