<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon solde</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
    <h1 class="mb-3">Mon solde de congés</h1>

    <p><a class="btn btn-secondary btn-sm" href="<?= site_url('employe') ?>">Retour</a></p>

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