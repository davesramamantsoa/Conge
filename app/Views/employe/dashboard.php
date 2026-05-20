<?php $currentPage = 'dashboard';
$pageTitle = 'Tableau de bord'; ?>
<?php include 'header.php'; ?>
<div class="header mb-3">
    <h1><i class="bi bi-house"></i> Tableau de bord</h1>
    <p class="text-muted">Bienvenue <?= htmlspecialchars(session('user_prenom') . ' ' . session('user_nom')) ?></p>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Actions rapides</h5>
            <div class="list-group mt-2">
                <a class="list-group-item list-group-item-action" href="<?= site_url('employe/nouvelle-demande') ?>">Soumettre une demande</a>
                <a class="list-group-item list-group-item-action" href="<?= site_url('employe/demandes') ?>">Voir mes demandes</a>
                <a class="list-group-item list-group-item-action" href="<?= site_url('employe/solde') ?>">Voir mon solde</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Infos</h5>
            <p class="mb-0"><strong>Rôle :</strong> <?= htmlspecialchars(session('user_role') ?? '') ?></p>
            <p class="mb-0"><strong>Email :</strong> <?= htmlspecialchars(session('user_email') ?? '') ?></p>
        </div>
    </div>
</div>
</div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<?php include 'footer.php'; ?>