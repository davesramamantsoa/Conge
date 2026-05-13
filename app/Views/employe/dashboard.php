<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Employé</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h1 class="mb-3">Dashboard Employé</h1>

    <p>Bienvenue <?= session('user_prenom') ?> <?= session('user_nom') ?></p>
    <p><strong>Rôle :</strong> <?= session('user_role') ?></p>

    <div class="list-group">
        <a class="list-group-item list-group-item-action" href="<?= site_url('employe/nouvelle-demande') ?>">Soumettre une demande de congé</a>
        <a class="list-group-item list-group-item-action" href="<?= site_url('employe/solde') ?>">Voir mon solde de congés</a>
        <a class="list-group-item list-group-item-action" href="<?= site_url('employe/demandes') ?>">Consulter mes demandes</a>
        <a class="list-group-item list-group-item-action" href="<?= site_url('employe/profil') ?>">Modifier mon profil</a>
    </div>
</div>
</body>
</html>
