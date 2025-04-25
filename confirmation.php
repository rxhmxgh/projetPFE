<?php
include 'rendezvous.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
  
    // 1. Enregistrement en base de données
    $stmt = $pdo->prepare("INSERT INTO rendezvous (nom, email, telephone, type, date, heure) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$nom, $email, $telephone, $type, $date, $heure])) {
      
      // 2. Envoyer un email de notification
      $destinataire = "rahmaghomari26@gmail.com"; // <-- Remplacer par l'email du conseiller
      $sujet = "Nouvelle demande de rendez-vous";
      $message = "
      Bonjour,
  
      Une nouvelle demande de rendez-vous a été enregistrée :
  
      Nom : $nom
      Email : $email
      Téléphone : $telephone
      Type de rendez-vous : $type
      Date : $date
      Heure : $heure
  
      Merci de traiter cette demande.
  
      ";
      $headers = "From: rahmaghomari26@gmail.com\r\n";
      $headers .= "Reply-To: rahmaghomari26@gmail.com\r\n";
      $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  
      if (mail($destinataire, $sujet, $message, $headers)) {
        echo "success";
      } else {
        echo "Erreur envoi email";
      }
  
    } else {
      echo "Erreur lors de l'enregistrement";
    }
  }
  ?>
  
