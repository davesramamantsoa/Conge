<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Employé' ?> - Gestion des congés</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap/bootstrap-icons/fonts/bootstrap-icons.css') ?>" rel="stylesheet">
    <style>
        :root {
            --forest: #2d5a3d;
            --success: #1e6b3f;
            --danger: #c0392b;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8f6f1;
        }

        .sidebar {
            background: var(--forest);
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .sidebar a {
            color: rgba(255, 255, 255, .7);
            text-decoration: none;
            display: block;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 4px 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(45, 90, 61, .3);
            color: white;
        }

        .container-main {
            padding: 2rem;
        }

        .card {
            border: 1px solid #dde8e1;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
        }
    </style>
</head>

<body>
    <div class="row g-0 min-vh-100">
        <div class="col-auto sidebar p-3">
            <h3 style="color: white; margin-bottom: 2rem;"><i class="bi bi-people"></i> Mon espace</h3>
            <nav class="d-flex flex-column">
                <a href="<?= base_url('/employe') ?>" <?= ($currentPage === 'dashboard') ? 'class="active"' : '' ?>><i class="bi bi-house"></i> Tableau de bord</a>
                <a href="<?= base_url('/employe/demandes') ?>" <?= ($currentPage === 'demandes') ? 'class="active"' : '' ?>><i class="bi bi-calendar-event"></i> Mes demandes</a>
                <a href="<?= base_url('/employe/nouvelle-demande') ?>" <?= ($currentPage === 'nouvelle_demande') ? 'class="active"' : '' ?>><i class="bi bi-pencil-square"></i> Nouvelle demande</a>
                <a href="<?= base_url('/employe/solde') ?>" <?= ($currentPage === 'solde') ? 'class="active"' : '' ?>><i class="bi bi-graph-up"></i> Mon solde</a>
                <a href="<?= base_url('/employe/calendrier') ?>" <?= ($currentPage === 'calendrier') ? 'class="active"' : '' ?>><i class="bi bi-calendar-check"></i> Mon calendrier</a>
                <a href="<?= base_url('/employe/profil') ?>" <?= ($currentPage === 'profil') ? 'class="active"' : '' ?>><i class="bi bi-person"></i> Mon profil</a>
            </nav>
            <a href="<?= base_url('/logout') ?>" class="btn btn-outline-light w-100" style="margin-top: auto; margin-bottom: 1rem;">Déconnexion</a>
        </div>

        <div class="col container-main">