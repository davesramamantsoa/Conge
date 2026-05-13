<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =============================================
// Routes d'accueil et consultation
// =============================================

// Route d'accueil - liste des livres
$routes->get('/', 'LivreController::accueil');
$routes->get('/livres', 'LivreController::accueil');

// Route pour afficher la fiche détaillée d'un livre
$routes->get('/livres/(:num)', 'LivreController::detail/$1');

// =============================================
// Routes pour ajouter un livre (2.3)
// =============================================

// GET - Afficher le formulaire d'ajout
$routes->get('/livres/ajouter', 'LivreController::ajouter');

// POST - Traiter l'envoi du formulaire
$routes->post('/livres/ajouter', 'LivreController::traiterAjout');

// =============================================
// Routes pour supprimer un livre (2.4)
// =============================================

// POST - Supprimer un livre
$routes->post('/livres/(:num)/supprimer', 'LivreController::supprimer/$1');

// =============================================
// Routes pour les actions de prêt et retour (2.5 / 6.1-6.2)
// =============================================

// POST - Emprunter un livre (6.1)
$routes->post('/livres/(:num)/emprunter', 'MouvementController::emprunter/$1');

// POST - Retourner un livre (6.2)
$routes->post('/livres/(:num)/retourner', 'MouvementController::retourner/$1');
