<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
    <?php $typesConge = $typesConge ?? []; ?>
    <?php $soldes = $soldes ?? []; ?>

    <h1 class="mb-3">Nouvelle demande de congé</h1>

    <p><a class="btn btn-secondary btn-sm" href="<?= site_url('employe/demandes') ?>">Retour aux demandes</a></p>

    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('employe/demandes/store') ?>" class="mb-4">
        <?= csrf_field() ?>

        <p class="mb-3">
            <label>Type de congé</label><br>
            <select name="type_conge_id" class="form-select" required>
                <option value="">Choisir</option>
                <?php foreach ($typesConge as $type): ?>
                    <option value="<?= (int) $type['id'] ?>"><?= htmlspecialchars($type['libelle'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p class="mb-3">
            <label>Date de début</label><br>
            <input type="date" name="date_debut" class="form-control" required>
        </p>

        <p class="mb-3">
            <label>Date de fin</label><br>
            <input type="date" name="date_fin" class="form-control" required>
        </p>

        <p class="mb-3">
            <label>Motif</label><br>
            <textarea name="motif" rows="4" class="form-control" required></textarea>
        </p>

        <p>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </p>
    </form>

    <h2>Mon solde</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Type</th>
            <th>Attribués</th>
            <th>Pris</th>
            <th>Restant</th>
        </tr>
        <?php if (! empty($soldes)): ?>
            <?php foreach ($soldes as $solde): ?>
                <tr>
                    <td><?= htmlspecialchars($solde['type_conge'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) ($solde['jours_attribues'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) ($solde['jours_pris'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) ($solde['restant'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun solde trouvé.</td>
            </tr>
        <?php endif; ?>
    </table>
    </div>
</body>
</html>