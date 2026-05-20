<?php $currentPage = 'profil';
$pageTitle = 'Mon profil'; ?>
<?php include 'header.php'; ?>
<a href="<?= base_url('/employe') ?>" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Retour</a>

<div class="header mb-3">
    <h1><i class="bi bi-person"></i> Modifier mon profil</h1>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card p-3">
    <form method="post" action="<?= site_url('employe/profil/update') ?>">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($employe['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($employe['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($employe['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="Laisser vide pour garder l'ancien">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
</div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<?php include 'footer.php'; ?>