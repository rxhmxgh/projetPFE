<?php
$pdo = new PDO("mysql:host=localhost;dbname=banquemoderne;charset=utf8", "root", "");
$stmt = $pdo->query("SELECT * FROM demandes_compte ORDER BY date_demande DESC");
$demandes = $stmt->fetchAll();
?>

<h2>Liste des demandes de comptes bancaires</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Type Compte</th>
        <th>Date</th>
        <th>Pièces jointes</th>
    </tr>
    <?php foreach ($demandes as $demande): ?>
    <tr>
        <td><?= $demande['id'] ?></td>
        <td><?= $demande['full_name'] ?></td>
        <td><?= $demande['email'] ?></td>
        <td><?= $demande['phone'] ?></td>
        <td><?= $demande['job_status'] ?></td>
        <td><?= $demande['date_demande'] ?></td>
        <td>
            <a href="uploads/<?= $demande['identity_file'] ?>">Identité</a><br>
            <a href="uploads/<?= $demande['extrait_file'] ?>">Extrait</a><br>
            <a href="uploads/<?= $demande['residence_file'] ?>">Résidence</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
