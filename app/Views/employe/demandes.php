<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes demandes</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
    <h1 class="mb-3">Mes demandes de congé</h1>

    <p>
        <a class="btn btn-secondary btn-sm" href="<?= site_url('employe') ?>">Retour</a>
        <a class="btn btn-primary btn-sm" href="<?= site_url('employe/nouvelle-demande') ?>">Nouvelle demande</a>
    </p>

    <?php if (session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Type</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Jours</th>
            <th>Motif</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        <?php if (! empty($demandes)): ?>
            <?php foreach ($demandes as $demande): ?>
                <tr>
                    <td><?= htmlspecialchars($demande['type_conge'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($demande['date_debut'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($demande['date_fin'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) ($demande['nb_jours'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($demande['motif'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($demande['statut'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
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
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune demande trouvée.</td>
            </tr>
        <?php endif; ?>
        </table>
        </div>
</body>
</html>