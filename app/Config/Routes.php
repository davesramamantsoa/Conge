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
$routes->get('/rh', function () {
    if (!session()->has('user_id') || session('user_role') !== 'rh') {
        return redirect()->to('/login')->with('error', 'Accès refusé. RH uniquement.');
    }
    return view('rh/dashboard');
});

// Routes protégées - Dashboard Employé
$routes->get('/employe', 'EmployeController::dashboard');
$routes->get('/employe/demandes', 'EmployeController::demandes');
$routes->get('/employe/nouvelle-demande', 'EmployeController::nouvelleDemande');
$routes->post('/employe/demandes/store', 'EmployeController::storeDemande');
$routes->post('/employe/demandes/cancel/(:num)', 'EmployeController::cancelDemande/$1');
$routes->get('/employe/solde', 'EmployeController::solde');
$routes->get('/employe/profil', 'EmployeController::profil');
$routes->post('/employe/profil/update', 'EmployeController::updateProfil');
