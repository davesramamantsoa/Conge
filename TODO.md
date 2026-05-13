# TODO - Création du site (niveau L2 Informatique)

Projet: Système de gestion de bibliothèque en PHP (CodeIgniter 4)
Auteur: Étudiant 2ème année Informatique

---

## BASE

- [ok] Installer l'environnement local
	- [ok] Vérifier la version de PHP compatible avec CodeIgniter 4
	- [ok] Installer et démarrer MySQL/MariaDB
	- [ok] Lancer un serveur local pour les tests (`php -S`)
	- [ok] Vérifier que l'extension `mysqli` est active
  
- [ok] Initialiser le projet CodeIgniter 4
	- [ok] Préparer la structure de base du framework
	- [ok] Vérifier le point d'entrée `public/index.php`
	- [ok] Tester l'exécution initiale sans erreur fatale

- [ok] Organiser l'arborescence du projet
	- [ok] Structurer `app/Controllers`, `app/Models`, `app/Views`
	- [ok] Préparer `public/uploads` pour les fichiers image
	- [ok] Garder `writable/` pour cache, logs et sessions

- [ok] Configurer le fichier `.env`
	- [ok] Définir `CI_ENVIRONMENT`
	- [ok] Configurer `app.baseURL`
	- [ok] Renseigner les paramètres DB (`hostname`, `database`, `username`, `password`, `port`)

- [ok] Créer la base de données `bibliotheque`
	- [ok] Créer le schéma principal
	- [ok] Vérifier les droits utilisateur (lecture/écriture)

- [ok] Créer les tables principales
	- [ok] Table `categories` (nom, emoji)
	- [ok] Table `livres` (infos livre + statut + couverture)
	- [ok] Table `emprunts` (historique des mouvements)
	- [ok] Définir les clés étrangères entre tables

- [ok] Préparer un script SQL d'initialisation
	- [ok] Ajouter des catégories par défaut
	- [ok] Ajouter un jeu de données de test (livres)
	- [ok] Vérifier l'import SQL sur une base vide

- [ok] Configurer les routes principales
	- [ok] Route d'accueil et catalogue (`/`, `/livres`)
	- [ok] Routes détail et ajout de livre
	- [ok] Routes des actions prêt / retour / suppression

## INTEGRATION

- [ok] Créer `LivreModel` avec validation
	- [ok] Définir `allowedFields`
	- [ok] Ajouter les règles (titre, auteur, ISBN, année, catégorie)
	- [ok] Ajouter les messages d'erreur personnalisés
	- [ok] Ajouter la validation métier (année non future)

- [ok] Créer `EmpruntModel`
	- [ok] Définir les champs d'emprunt (livre, emprunteur, dates)
	- [ok] Gérer l'emprunt actif (sans date de retour)

- [ok] Ajouter les requêtes avec jointures
	- [ok] Jointure `livres` + `categories` pour nom + emoji
	- [ok] Méthode recherche avec filtre catégorie optionnel
	- [ok] Méthode détail livre enrichi

- [ok] Brancher les contrôleurs
	- [ok] `LivreController` pour consultation + CRUD
	- [ok] `MouvementController` pour prêt / retour
	- [ok] Préparer les données envoyées aux vues

- [ok] Implémenter les actions principales
	- [ok] Lister les livres (avec pagination)
	- [ok] Afficher la fiche détaillée
	- [ok] Ajouter un livre
	- [ok] Supprimer un livre

- [ok] Connecter les formulaires HTML
	- [ok] Méthodes `POST` correctes sur les formulaires
	- [ok] Redirection + conservation des anciennes valeurs (`withInput`)

- [ok] Gérer l'upload des couvertures
	- [ok] Vérifier format autorisé (jpeg/png/webp)
	- [ok] Vérifier taille max
	- [ok] Enregistrer le nom de fichier en base

- [ok] Ajouter les retours utilisateur
	- [ok] Messages flash succès
	- [ok] Messages flash erreur
	- [ok] Affichage des erreurs de validation

- [ok] Gérer pagination et recherche
	- [ok] Pagination sur la liste principale
	- [ok] Recherche par mot-clé
	- [ok] Filtre par catégorie

- [ok] Vérifier la logique des statuts
	- [ok] Passage `disponible` -> `prete` lors d'un emprunt
	- [ok] Passage `prete` -> `disponible` lors d'un retour

## DESIGN

- [ok] Créer une base CSS commune
	- [ok] Variables de couleurs globales
	- [ok] Styles boutons réutilisables
	- [ok] Styles formulaires cohérents
	- [ok] Navigation + pied de page harmonisés

- [ok] Migrer vers un thème full dark
	- [ok] Fonds principaux en teintes sombres
	- [ok] Cartes/panels en sombre secondaire
	- [ok] Liens et accents visibles

- [ok] Harmoniser les couleurs
	- [ok] Réduire les fonds clairs restants
	- [ok] Uniformiser les bordures et ombres
	- [ok] Ajuster les couleurs de statut (vert/rouge)

- [ok] Corriger la lisibilité
	- [ok] Augmenter le contraste texte/fond
	- [ok] Ajuster taille et graisse des titres
	- [ok] Vérifier placeholders et labels

- [ok] Changer l'affichage du catalogue
	- [ok] Remplacer le tableau par des cartes circulaires
	- [ok] Ajouter image de couverture dans le cercle
	- [ok] Garder les actions (détail, prêt, retour, suppression)

- [ok] Styliser les états métier
	- [ok] Badge "Disponible"
	- [ok] Badge "Prêté"
	- [ok] Style cohérent entre liste et détail

- [ok] Ajouter le responsive
	- [ok] Grilles adaptatives
	- [ok] Boutons lisibles sur mobile
	- [ok] Formulaires utilisables sur petit écran

- [ok] Préparer SCSS + CSS
	- [ok] Garder les sources dans `public/scss`
	- [ok] Générer les fichiers de sortie dans `public/css`

- [ok] Mettre en place la compilation SCSS
	- [ok] Ajouter `sass` en dépendance dev
	- [ok] Script `scss:build`
	- [ok] Script `scss:watch`

## FONCTION

- [ok] Afficher la liste des livres au démarrage
	- [ok] Charger les livres depuis la base
	- [ok] Afficher titre, auteur, catégorie, statut

- [ok] Voir le détail d'un livre
	- [ok] Afficher les métadonnées complètes
	- [ok] Gérer le cas livre introuvable (404)

- [ok] Ajouter un nouveau livre avec validation
	- [ok] Contrôler les champs obligatoires
	- [ok] Refuser les valeurs invalides
	- [ok] Sauvegarder en base

- [ok] Supprimer un livre
	- [ok] Confirmation côté interface
	- [ok] Suppression en base + message de retour

- [ok] Emprunter un livre
	- [ok] Saisir nom emprunteur
	- [ok] Créer mouvement d'emprunt
	- [ok] Mettre le statut à `prete`

- [ok] Retourner un livre
	- [ok] Clôturer l'emprunt actif
	- [ok] Renseigner date de retour
	- [ok] Remettre le statut à `disponible`

- [ok] Afficher le dernier emprunt dans la page détail
	- [ok] Nom de l'emprunteur
	- [ok] Date d'emprunt / retour
	- [ok] Statut du mouvement

- [ok] Recherche et filtre
	- [ok] Recherche texte (titre/auteur)
	- [ok] Filtre par catégorie
	- [ok] Réinitialisation des filtres

- [ok] Afficher la couverture uploadée
	- [ok] Utiliser l'image depuis `public/uploads` si disponible
	- [ok] Afficher un emoji de fallback sinon

- [ok] Sécuriser les formulaires
	- [ok] Ajouter `csrf_field()` partout en POST
	- [ok] Vérifier routes POST uniquement pour actions sensibles