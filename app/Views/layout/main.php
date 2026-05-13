<?php
/**
 * Layout Principal - Fichier de mise en page commune
 * Inclut la barre de navigation, les messages flash et la zone de contenu dynamique
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description ?? 'Système de Gestion de Bibliothèque Numérique' ?>">
    <title><?= $title ?? 'Bibliothèque' ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('css/base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/' . ($cssFile ?? 'accueil_new.css')) ?>">
    
    <!-- Favicon -->
    <!-- Navigation principale -->
    <nav>
        <div class="nav-container">
            <a href="<?= base_url('/') ?>" class="nav-brand">📚 Bibliothèque</a>
            <ul>
                <li><a href="<?= base_url('/livres') ?>">📖 Catalogue</a></li>
                <li><a href="<?= base_url('/livres/ajouter') ?>">➕ Ajouter</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="main-container">
        <!-- Affichage des messages flash -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                ✓ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                ⚠️ <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('warning')): ?>
            <div class="alert alert-warning">
                ⚡ <?= session()->getFlashdata('warning') ?>
            </div>
        <?php endif; ?>

        <!-- Contenu de la page -->
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Pied de page -->
    <footer>
        <p>&copy; 2026 Système de Gestion de Bibliothèque - Tous droits réservés</p>
        <p>Développé avec CodeIgniter 4</p>
    </footer>

    <!-- Scripts -->
    <script src="<?= base_url('js/main.js') ?>"></script>
    <?php if (isset($additionalScripts)): ?>
        <?php foreach ($additionalScripts as $script): ?>
            <script src="<?= base_url('js/' . $script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

