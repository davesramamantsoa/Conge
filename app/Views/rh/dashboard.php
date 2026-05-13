<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard RH - TechMada RH</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #f8f6f1; padding: 2rem; }
        .container { max-width: 1200px; background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h1 { color: #2d5a3d; margin-bottom: 1rem; }
        .badge { margin-left: auto; }
        .logout-btn { float: right; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger logout-btn">Déconnexion</a>
        
        <h1><i class="bi bi-person-check"></i> Dashboard RH</h1>
        <p class="text-muted">Bienvenue <strong><?= session('user_prenom') ?> <?= session('user_nom') ?></strong></p>
        
        <div class="alert alert-info">
            <strong>Rôle :</strong> <?= session('user_role') ?>
        </div>

        <h2>Fonctionnalités RH</h2>
        <ul class="list-group">
            <li class="list-group-item">Approbation des demandes de congés</li>
            <li class="list-group-item">Gestion des soldes de congés</li>
            <li class="list-group-item">Suivi des employés</li>
            <li class="list-group-item">Génération de rapports</li>
        </ul>
    </div>
</body>
</html>
