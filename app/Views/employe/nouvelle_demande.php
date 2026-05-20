<?php $currentPage = 'nouvelle_demande';
$pageTitle = 'Nouvelle demande'; ?>
<?php include 'header.php'; ?>
<a href="<?= base_url('/employe/demandes') ?>" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Retour aux demandes</a>

<div class="header mb-3">
    <h1><i class="bi bi-pencil-square"></i> Nouvelle demande de congé</h1>
</div>

<?php $typesConge = $typesConge ?? [];
$soldes = $soldes ?? []; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card mb-4 p-3">
    <form method="post" action="<?= site_url('employe/demandes/store') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Type de congé</label>
            <select name="type_conge_id" class="form-select" required>
                <option value="">Choisir</option>
                <?php foreach ($typesConge as $type): ?>
                    <option value="<?= (int) $type['id'] ?>"><?= htmlspecialchars($type['libelle'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date de début</label>
                <input type="date" name="date_debut" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Date de fin</label>
                <input type="date" name="date_fin" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Motif</label>
            <textarea name="motif" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">Mon solde</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped mb-0">
            <thead>
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
                            <td><?= (int) ($solde['annee'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($solde['type_conge'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($solde['jours_attribues'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($solde['jours_pris'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($solde['restant'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
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