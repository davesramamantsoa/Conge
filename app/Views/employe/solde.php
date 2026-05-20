<?php $currentPage = 'solde';
$pageTitle = 'Mon solde'; ?>
<?php include 'header.php'; ?>
<a href="<?= base_url('/employe') ?>" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Retour</a>

<div class="header mb-3">
    <h1><i class="bi bi-graph-up"></i> Mon solde de congés</h1>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Année</th>
                    <th>Type</th>
                    <th>Attribués</th>
                    <th>Pris</th>
                    <th>Restant</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($soldes)): ?>
                    <?php foreach ($soldes as $solde): ?>
                        <tr>
                            <td><strong><?= (int) ($solde['annee'] ?? '-') ?></strong></td>
                            <td><strong><?= htmlspecialchars($solde['type_conge'] ?? '-', ENT_QUOTES, 'UTF-8') ?></strong></td>
                            <td><?= htmlspecialchars((string) ($solde['jours_attribues'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($solde['jours_pris'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><strong><?= htmlspecialchars((string) ($solde['restant'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucun solde trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<?php include 'footer.php'; ?>