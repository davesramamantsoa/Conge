<?php
$title = $title ?? 'Admin';
$active = $active ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - TechMada RH</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #eef3f8;
            --admin-panel: #ffffff;
            --admin-sidebar: #122033;
            --admin-accent: #316bff;
            --admin-accent-2: #18a36a;
            --admin-border: #dbe3ee;
            --admin-text: #1e293b;
            --admin-muted: #64748b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: linear-gradient(180deg, #f6f8fb 0%, var(--admin-bg) 100%);
            color: var(--admin-text);
        }

        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
        }

        .admin-sidebar {
            background: linear-gradient(180deg, var(--admin-sidebar) 0%, #0d1726 100%);
            color: #fff;
            padding: 1.5rem;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: .85rem;
            margin-bottom: 1.5rem;
        }

        .brand-badge {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(255,255,255,.12);
            display: grid;
            place-items: center;
            font-size: 1.3rem;
        }

        .brand h1 { font-size: 1.05rem; margin: 0; }
        .brand p { margin: 0; color: rgba(255,255,255,.65); font-size: .9rem; }

        .nav-section { margin-top: 1.25rem; }
        .nav-label { text-transform: uppercase; letter-spacing: .08em; font-size: .75rem; color: rgba(255,255,255,.5); margin-bottom: .5rem; }

        .admin-nav a {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .8rem 1rem;
            margin-bottom: .4rem;
            color: rgba(255,255,255,.86);
            text-decoration: none;
            border-radius: 14px;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: rgba(255,255,255,.11);
            color: #fff;
        }

        .admin-nav i { width: 1.2rem; }

        .admin-main { padding: 1.5rem; }

        .page-shell {
            background: rgba(255,255,255,.72);
            border: 1px solid rgba(219,227,238,.9);
            box-shadow: 0 20px 45px rgba(15,23,42,.08);
            border-radius: 28px;
            padding: 1.25rem;
            backdrop-filter: blur(10px);
        }

        .page-head { display: flex; justify-content: space-between; align-items: start; gap: 1rem; margin-bottom: 1.5rem; }
        .page-head h2 { margin: 0; font-size: 1.65rem; }
        .page-head p { margin: .25rem 0 0; color: var(--admin-muted); }

        .panel {
            background: var(--admin-panel);
            border: 1px solid var(--admin-border);
            border-radius: 22px;
            padding: 1.25rem;
            box-shadow: 0 10px 25px rgba(15,23,42,.04);
        }

        .metric {
            border-radius: 22px;
            padding: 1.25rem;
            color: #fff;
            min-height: 132px;
            background: linear-gradient(135deg, var(--admin-accent) 0%, #5a85ff 100%);
            box-shadow: 0 16px 30px rgba(49,107,255,.22);
        }

        .metric.success {
            background: linear-gradient(135deg, var(--admin-accent-2) 0%, #32c48c 100%);
            box-shadow: 0 16px 30px rgba(24,163,106,.2);
        }

        .metric.dark { background: linear-gradient(135deg, #334155 0%, #0f172a 100%); }
        .metric .value { font-size: 2rem; font-weight: 800; line-height: 1; }
        .metric .label { opacity: .9; font-size: .95rem; }

        .table thead th {
            background: #f6f8fb;
            color: var(--admin-muted);
            border-bottom: 1px solid var(--admin-border);
        }

        .badge-soft { border-radius: 999px; padding: .45rem .7rem; }
        .status-en_attente { background: #fff4d6; color: #9a6700; }
        .status-approuvee { background: #dcfce7; color: #166534; }
        .status-refusee { background: #fee2e2; color: #991b1b; }
        .status-annulee { background: #e2e8f0; color: #334155; }

        @media (max-width: 992px) {
            .admin-shell { grid-template-columns: 1fr; }
            .admin-sidebar { position: relative; height: auto; }
        }
    </style>
</head>
<body>
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="brand">
            <div class="brand-badge"><i class="bi bi-shield-check"></i></div>
            <div>
                <h1>Back-office Admin</h1>
                <p>TechMada RH</p>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-label">Navigation</div>
            <nav class="admin-nav">
                <a class="<?= $active === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('/admin') ?>"><i class="bi bi-speedometer2"></i> Tableau de bord</a>
                <a class="<?= $active === 'employes' ? 'active' : '' ?>" href="<?= base_url('/admin/employes') ?>"><i class="bi bi-people"></i> Employés</a>
                <a class="<?= $active === 'departements' ? 'active' : '' ?>" href="<?= base_url('/admin/departements') ?>"><i class="bi bi-diagram-3"></i> Départements</a>
                <a class="<?= $active === 'types' ? 'active' : '' ?>" href="<?= base_url('/admin/types-conges') ?>"><i class="bi bi-calendar-heart"></i> Types de congé</a>
                <a class="<?= $active === 'absences' ? 'active' : '' ?>" href="<?= base_url('/admin/absences') ?>"><i class="bi bi-calendar2-week"></i> Absences du mois</a>
                <a class="<?= $active === 'soldes' ? 'active' : '' ?>" href="<?= base_url('/admin/soldes') ?>"><i class="bi bi-wallet2"></i> Soldes annuels</a>
                <a class="<?= $active === 'historique' ? 'active' : '' ?>" href="<?= base_url('/admin/historique') ?>"><i class="bi bi-clock-history"></i> Historique complet</a>
            </nav>
        </div>

        <div class="nav-section">
            <div class="nav-label">Compte</div>
            <div class="panel bg-transparent border-0 text-white p-0">
                <div class="mb-2 fw-semibold"><?= esc((string) (session('user_prenom') ?? '')) ?> <?= esc((string) (session('user_nom') ?? '')) ?></div>
                <div class="text-white-50 mb-3">Rôle : admin</div>
                <a href="<?= base_url('/logout') ?>" class="btn btn-outline-light btn-sm w-100">Déconnexion</a>
            </div>
        </div>
    </aside>

    <main class="admin-main">
        <div class="page-shell">
            <?php $successMessage = (string) (session()->getFlashdata('success') ?? ''); $errorMessage = (string) (session()->getFlashdata('error') ?? ''); ?>
            <?php if ($successMessage): ?>
                <div class="alert alert-success mb-4"><?= esc($successMessage) ?></div>
            <?php endif; ?>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger mb-4"><?= esc($errorMessage) ?></div>
            <?php endif; ?>