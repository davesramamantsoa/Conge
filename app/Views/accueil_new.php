<?php $this->extend('layout/main') ?>

<?php $this->section('content') ?>
<div class="accueil-hero" style="padding: 60px 40px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%); border-radius: 15px; color: white; text-align: center; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
    <h1 style="font-size: 3em; margin-bottom: 15px; font-weight: 800; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">📚 Bibliothèque Numérique</h1>
    <p style="font-size: 1.3em; margin-bottom: 25px; opacity: 0.95;">Découvrez notre collection complète de livres</p>
    <a href="<?= base_url('livres/ajouter') ?>" class="btn btn-primary" style="margin: 0 10px; font-size: 1.1em; padding: 12px 30px;">➕ Ajouter un livre</a>
</div>

<!-- Section Recherche -->
<div class="search-section" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); margin-bottom: 40px;">
    <h3 style="margin-bottom: 20px; color: #667eea; font-size: 1.3em;">🔍 Rechercher un livre</h3>
    <form method="GET" action="<?= base_url('/') ?>" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
        <div style="flex: 1; min-width: 250px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">Titre ou Auteur</label>
            <input 
                type="text" 
                name="motCle" 
                placeholder="Rechercher..." 
                value="<?= esc($motCle ?? '') ?>"
                style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: all 0.3s;"
            >
        </div>
        <div style="flex: 0 1 200px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">Catégorie</label>
            <select 
                name="categorie_id" 
                style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; background: white;"
            >
                <option value="">-- Toutes les catégories --</option>
                <option value="1" <?= ($categorie_id === '1' || $categorie_id === 1) ? 'selected' : '' ?>>📖 Roman</option>
                <option value="2" <?= ($categorie_id === '2' || $categorie_id === 2) ? 'selected' : '' ?>>🤔 Philosophie</option>
                <option value="3" <?= ($categorie_id === '3' || $categorie_id === 3) ? 'selected' : '' ?>>💻 Informatique</option>
                <option value="4" <?= ($categorie_id === '4' || $categorie_id === 4) ? 'selected' : '' ?>>🔬 Science</option>
                <option value="5" <?= ($categorie_id === '5' || $categorie_id === 5) ? 'selected' : '' ?>>📜 Histoire</option>
                <option value="6" <?= ($categorie_id === '6' || $categorie_id === 6) ? 'selected' : '' ?>>✨ Poésie</option>
            </select>
        </div>
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 25px;">🔍 Rechercher</button>
            <?php if ($motCle || $categorie_id): ?>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary" style="padding: 12px 20px; text-decoration: none;">↺ Réinitialiser</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Grille de Livres -->
<?php if (!empty($livres)): ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; margin-bottom: 40px;">
        <?php foreach ($livres as $livre): ?>
            <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                <div style="width: 100%; height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; font-size: 5em; color: white;">📚</div>
                
                <div style="padding: 20px;">
                    <h3 style="font-size: 1.2em; font-weight: 700; color: #2c3e50; margin-bottom: 8px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?= esc($livre['titre']) ?>
                    </h3>
                    
                    <p style="color: #7f8c8d; font-size: 0.95em; margin-bottom: 10px;">
                        <?= esc($livre['auteur']) ?>
                    </p>
                    
                    <span style="display: inline-block; background: #667eea; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.85em; margin-bottom: 15px;">
                        <?= ($livre['emoji'] ?? '📚') . ' ' . esc($livre['categorie_nom'] ?? '-') ?>
                    </span>
                    
                    <div style="padding: 10px; border-radius: 6px; text-align: center; font-weight: 600; margin-bottom: 15px; background: <?= ($livre['statut'] === 'disponible') ? '#d4edda' : '#f8d7da' ?>; color: <?= ($livre['statut'] === 'disponible') ? '#155724' : '#721c24' ?>;">
                        <?= $livre['statut'] === 'disponible' ? '✓ Disponible' : '✗ Emprunté' ?>
                    </div>
                    
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <a href="<?= base_url('livres/' . esc($livre['id'])) ?>" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 0.9em; padding: 8px 12px; text-decoration: none;">👁️ Voir</a>
                        <?php if ($livre['statut'] === 'disponible'): ?>
                            <form method="POST" action="<?= base_url('livres/' . $livre['id'] . '/emprunter') ?>" style="flex: 1;">
                                <button type="submit" class="btn btn-success" style="width: 100%; font-size: 0.9em; padding: 8px 12px;">📥 Emprunter</button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="<?= base_url('livres/' . $livre['id'] . '/retourner') ?>" style="flex: 1;">
                                <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 0.9em; padding: 8px 12px;">📤 Retourner</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div style="background: white; padding: 60px 40px; text-align: center; border-radius: 12px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); color: #7f8c8d;">
        <h2 style="color: #2c3e50; margin-bottom: 10px; font-size: 1.8em;">📚 Aucun livre trouvé</h2>
        <p style="font-size: 1.1em; margin-bottom: 25px;">Aucun livre ne correspond à vos critères de recherche.</p>
        <a href="<?= base_url('/') ?>" class="btn btn-primary" style="padding: 12px 25px; text-decoration: none;">← Retour</a>
    </div>
<?php endif; ?>

<?php $this->endSection() ?>
