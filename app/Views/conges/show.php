<?php helper('url'); ?>
<?php
$conge = $conge ?? [];
$congeData = is_array($conge) ? $conge : (array) $conge;
$nomEmploye = trim(($congeData['prenom_employe'] ?? '') . ' ' . ($congeData['nom_employe'] ?? ''));
$nomEmploye = $nomEmploye !== '' ? $nomEmploye : '-';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détail du congé</title>
</head>
<body>
<h1>Détail du congé</h1>

<p><a href="<?= site_url('conges') ?>">Retour</a></p>

<p><strong>Employé :</strong> <?= $nomEmploye ?></p>
<p><strong>Type :</strong> <?= $congeData['type_conge'] ?? '-' ?></p>
<p><strong>Date de début :</strong> <?= $congeData['date_debut'] ?? '-' ?></p>
<p><strong>Date de fin :</strong> <?= $congeData['date_fin'] ?? '-' ?></p>
<p><strong>Nombre de jours :</strong> <?= $congeData['nb_jours'] ?? '-' ?></p>
<p><strong>Statut :</strong> <?= $congeData['statut'] ?? 'En attente' ?></p>
<p><strong>Traité par :</strong> <?= $congeData['traite_par'] ?? '-' ?></p>
<p><strong>Motif :</strong> <?= $congeData['motif'] ?? '-' ?></p>
<p><strong>Commentaire RH :</strong> <?= $congeData['commentaire_rh'] ?? '-' ?></p>
</body>
</html>