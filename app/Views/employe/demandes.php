<?php $currentPage = 'demandes';
$pageTitle = 'Mes demandes'; ?>
<?php include 'header.php'; ?>
<a href="<?= base_url('/employe') ?>" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Retour</a>

<div class="header mb-3">
    <h1><i class="bi bi-calendar-event"></i> Mes demandes de congé</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($demandes)): ?>
            <div class="p-4 text-center text-muted">Aucune demande trouvée.</div>
        <?php else: ?>
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Type</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Jours</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $demande): ?>
                        <tr>
                            <td><?= htmlspecialchars($demande['type_conge'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($demande['date_debut'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($demande['date_fin'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><strong><?= htmlspecialchars((string) ($demande['nb_jours'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></strong></td>
                            <td><?= htmlspecialchars($demande['motif'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <span class="badge bg-<?= ($demande['statut'] === 'en_attente') ? 'warning' : (($demande['statut'] === 'approuvee') ? 'success' : 'danger') ?>">
                                    <?= htmlspecialchars(ucfirst($demande['statut'] ?? '-')) ?>
                                </span>
                            </td>
                            <td>
                                <?php if (($demande['statut'] ?? '') === 'en_attente'): ?>
                                    <form method="post" action="<?= site_url('employe/demandes/cancel/' . ($demande['id'] ?? 0)) ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                    </form>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
</div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<?php include 'footer.php'; ?>