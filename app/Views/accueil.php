<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('css/base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/accueil_new.css') ?>">
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 Bibliothèque Numérique</h1>
            <p>Découvrez notre collection de livres</p>
            <a href="<?= base_url('livres/ajouter') ?>" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                ➕ Ajouter un livre
            </a>
        </header>

        <?php if (session()->getFlashdata('success')): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                ✓ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #dc3545;">
                ⚠️ <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de recherche (5.1) -->
        <div class="search-section" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
            <h3>🔍 Rechercher un livre</h3>
            <form method="GET" action="<?= base_url('/') ?>" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <input 
                    type="text" 
                    name="motCle" 
                    placeholder="Titre ou auteur..." 
                    value="<?= esc($motCle ?? '') ?>"
                    style="flex: 1; min-width: 200px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                >
                <select 
                    name="categorie" 
                    style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; min-width: 150px;"
                >
                    <option value="">-- Toutes les catégories --</option>
                    <option value="Roman" <?= ($categorie === 'Roman') ? 'selected' : '' ?>>📖 Roman</option>
                    <option value="Philosophie" <?= ($categorie === 'Philosophie') ? 'selected' : '' ?>>🤔 Philosophie</option>
                    <option value="Informatique" <?= ($categorie === 'Informatique') ? 'selected' : '' ?>>💻 Informatique</option>
                    <option value="Science" <?= ($categorie === 'Science') ? 'selected' : '' ?>>🔬 Science</option>
                    <option value="Histoire" <?= ($categorie === 'Histoire') ? 'selected' : '' ?>>📜 Histoire</option>
                    <option value="Poésie" <?= ($categorie === 'Poésie') ? 'selected' : '' ?>>✨ Poésie</option>
                </select>
                <button 
                    type="submit" 
                    style="padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: all 0.3s;"
                >
                    Rechercher
                </button>
                <?php if ($motCle || $categorie): ?>
                    <a 
                        href="<?= base_url('/') ?>" 
                        style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: all 0.3s; text-align: center;"
                    >
                        Réinitialiser
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="books-section">
            <h2>Tous nos livres</h2>
            
            <?php if (!empty($livres)): ?>
                <div class="books-grid">
                    <?php foreach ($livres as $livre): ?>
                        <div class="book-card">
                            <div class="book-cover">
                                <?php 
                                    // Génère un emoji basé sur la catégorie
                                    $emojis = [
                                        'Roman' => '📖',
                                        'Philosophie' => '🤔',
                                        'Informatique' => '💻',
                                        'Science' => '🔬',
                                        'Histoire' => '📜',
                                        'Poésie' => '✨',
                                    ];
                                    echo $emojis[$livre['categorie']] ?? '📚';
                                ?>
                            </div>
                            <div class="book-content">
                                <div class="book-title"><?= esc($livre['titre']) ?></div>
                                <div class="book-author">par <?= esc($livre['auteur']) ?></div>
                                
                                <?php if (!empty($livre['categorie'])): ?>
                                    <div class="book-categorie"><?= esc($livre['categorie']) ?></div>
                                <?php endif; ?>
                                
                                <div class="book-meta">
                                    <strong>ISBN:</strong> <?= esc($livre['isbn']) ?>
                                </div>
                                
                                <?php if (!empty($livre['annee_publication'])): ?>
                                    <div class="book-meta">
                                        <strong>Année:</strong> <?= $livre['annee_publication'] ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($livre['resume'])): ?>
                                    <div class="book-resume">
                                        <?= esc(substr($livre['resume'], 0, 100)) ?>...
                                    </div>
                                <?php endif; ?>
                                
                                <div class="book-status status-<?= $livre['statut'] ?>">
                                    <?php 
                                        echo $livre['statut'] === 'disponible' 
                                            ? '✓ Disponible' 
                                            : '⊗ Prêté';
                                    ?>
                                </div>

                                <div style="margin-top: 15px; display: flex; gap: 8px; flex-wrap: wrap;">
                                    <a href="<?= base_url('livres/' . $livre['id']) ?>" style="flex: 1; color: #667eea; text-decoration: none; font-weight: bold; padding: 8px; border: 2px solid #667eea; border-radius: 5px; text-align: center; transition: all 0.3s; min-width: 120px;">
                                        Détails →
                                    </a>
                                    <form method="POST" action="<?= base_url('livres/' . $livre['id'] . '/supprimer') ?>" style="flex: 1; min-width: 100px;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" style="width: 100%; padding: 8px; background: #e74c3c; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: all 0.3s;">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination (5.1) -->
                <?php if (!($motCle || $categorie) && $pager): ?>
                    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                        <?= $pager->links() ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="empty-message">
                    <p>Aucun livre disponible pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
