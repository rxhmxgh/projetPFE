<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'banquemoderne';
$user = 'root';
$pass = '';

include 'rendezvous.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
  
    // Vérifier si l'heure est déjà prise
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM rendezvous WHERE date_rdv = ? AND heure_rdv = ? AND type_rdv = ?");
  $stmt->execute([$date, $heure, $type]);
  $existe = $stmt->fetchColumn();

  if ($existe > 0) {
    echo "Ce créneau est déjà réservé.";
    exit;
  }

  
}

    // 1. Enregistrement en base de données
     // Enregistrement en base de données
     $insert = $pdo->prepare("INSERT INTO rendezvous (nom, email, telephone, type_rdv, date_rdv, heure_rdv) VALUES (?, ?, ?, ?, ?, ?)");
    
     if ($insert->execute([$nom, $email, $telephone, $type, $date, $heure])) {
         
         // Envoyer un email de notification
         $destinataire = "rahmaghomari26@gmail.com"; // <-- à modifier si nécessaire
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
  
  ?>
  
