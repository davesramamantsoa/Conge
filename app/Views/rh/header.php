<?php
$title = $title ?? 'RH';
$currentPage = $currentPage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Gestion des congés</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap/bootstrap-icons/fonts/bootstrap-icons.css') ?>" rel="stylesheet">
    <style>
        :root {
            --forest: #2d5a3d;
            --success: #1e6b3f;
            --danger: #c0392b;
            --warn: #b8750a;
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
            transition: all .2s;
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
            <h3 style="color: white; margin-bottom: 2rem;"><i class="bi bi-shield-check"></i> RH</h3>
            <nav class="d-flex flex-column">
                <a href="<?= base_url('/rh') ?>" <?= ($currentPage === 'dashboard') ? 'class="active"' : '' ?>><i class="bi bi-house"></i> Tableau de bord</a>
                <a href="<?= base_url('/rh/soldes') ?>" <?= ($currentPage === 'soldes') ? 'class="active"' : '' ?>><i class="bi bi-graph-up"></i> Gestion des soldes</a>
            </nav>
            <a href="<?= base_url('/logout') ?>" class="btn btn-outline-light w-100" style="margin-top: auto; margin-bottom: 1rem;">Déconnexion</a>
        </div>

        <div class="col container-main">