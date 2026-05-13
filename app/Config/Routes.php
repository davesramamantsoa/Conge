<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route racine : rediriger vers login
$routes->get('/', 'Auth::login');

// Routes d'authentification
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

// Routes protégées - Dashboard Admin
$routes->get('/admin', function () {
    if (!session()->has('user_id') || session('user_role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Accès refusé. Admin uniquement.');
    }
    return view('admin/dashboard');
});

// Routes protégées - Dashboard RH
$routes->get('/rh', 'RH::dashboard');
$routes->get('/rh/filter-departement/(:num)', 'RH::filterByDepartement/$1');
$routes->get('/rh/filter-statut/(:any)', 'RH::filterByStatut/$1');
$routes->post('/rh/approve/(:num)', 'RH::approveDemande/$1');
$routes->post('/rh/refuse/(:num)', 'RH::refuseDemande/$1');
$routes->get('/rh/soldes', 'RH::soldes');
$routes->get('/rh/employe/(:num)', 'RH::demandesEmploye/$1');

// Routes protégées - Dashboard Employé
$routes->get('/employe', 'EmployeController::dashboard');
$routes->get('/employe/demandes', 'EmployeController::demandes');
$routes->get('/employe/nouvelle-demande', 'EmployeController::nouvelleDemande');
$routes->post('/employe/demandes/store', 'EmployeController::storeDemande');
$routes->post('/employe/demandes/cancel/(:num)', 'EmployeController::cancelDemande/$1');
$routes->get('/employe/solde', 'EmployeController::solde');
$routes->get('/employe/profil', 'EmployeController::profil');
$routes->post('/employe/profil/update', 'EmployeController::updateProfil');
