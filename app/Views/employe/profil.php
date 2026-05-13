<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
    <h1 class="mb-3">Modifier mon profil</h1>

    <p><a class="btn btn-secondary btn-sm" href="<?= site_url('employe') ?>">Retour</a></p>

    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('employe/profil/update') ?>" class="mb-4">
        <?= csrf_field() ?>

        <p class="mb-3">
            <label>Nom</label><br>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($employe['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </p>

        <p class="mb-3">
            <label>Prénom</label><br>
            <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($employe['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </p>

        <p class="mb-3">
            <label>Email</label><br>
            <input type="email" class="form-control" value="<?= htmlspecialchars($employe['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" readonly>
        </p>

        <p class="mb-3">
            <label>Nouveau mot de passe</label><br>
            <input type="password" name="password" class="form-control" placeholder="Laisser vide pour garder l'ancien">
        </p>

        <p>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </p>
    </form>
    </div>
</body>
</html>