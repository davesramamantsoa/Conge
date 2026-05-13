# 📋 TechMada RH - Gestion des Congés

> Système de gestion des demandes de congés développé avec **CodeIgniter 4** et **SQLite**

##  Vue d'ensemble

TechMada RH est une application web pour gérer les demandes de congés des employés d'une entreprise. Elle propose des interfaces spécifiques pour les trois rôles : **Admin**, **RH (Responsable Ressources Humaines)**, et **Employé**.

### Fonctionnalités principales

-  **Authentification sécurisée** avec bcrypt pour les mots de passe
-  **Gestion des demandes de congés** (création, approbation, refus)
-  **Suivi des soldes de congés** avec mise à jour automatique
-  **Filtrage des demandes** par statut (en attente, approuvée, refusée)
-  **Interface RH complète** pour la gestion des demandes
-  **Système de commentaires** pour les refus de demandes
-  **Dashboard rôle-spécifique** après connexion

---

##  Architecture

### Base de données (SQLite)

**5 tables principales :**

```
├── departements          # Départements de l'entreprise
├── employes             # Employés (id, nom, email, password, rôle)
├── types_conge          # Types de congés (Congé payé, RTT, Maladie, etc.)
├── soldes               # Soldes de congés par employé/type/année
└── conges               # Demandes de congé (statut, dates, commentaires)
```

### Modèles (MVC)

```
app/Models/
├── Employee.php         # Gestion des employés, authentification
├── Conge.php           # Gestion des demandes de congé
├── Solde.php           # Gestion des soldes et calculs
```

### Contrôleurs

```
app/Controllers/
├── Auth.php            # Login/Logout - Authentification
├── RH.php              # Dashboard RH - Gestion des demandes
├── EmployeController.php # Dashboard Employé - Demandes personnelles
└── Admin.php           # Dashboard Admin - Gestion système
```

### Vues

```
app/Views/
├── login/login.php                # Formulaire de connexion
├── rh/
│   ├── dashboard.php             # Demandes en attente + filtres
│   ├── soldes.php                # Tableau des soldes
│   └── demandes-employe.php      # Détails employé
├── employe/
│   ├── dashboard.php
│   ├── demandes.php
│   └── nouvelle-demande.php
└── admin/                         # Interfaces d'administration
```

---

##  Authentification et Rôles

### Trois rôles disponibles

| Rôle | Accès | Fonctionnalités |
|------|-------|-----------------|
| **Admin** | `/admin` | Gestion complète : employés, départements, types de congés, soldes |
| **RH** | `/rh` | Validation des demandes, suivi des soldes, commentaires |
| **Employé** | `/employe` | Création de demandes, suivi du solde personnel |

### Comptes de démonstration

```
Rôle       | Email                        | Mot de passe
-----------|------------------------------|------------------
RH         | sophie.martin@example.com    | hash_pwd_1
Admin      | pierre.bernard@example.com   | hash_pwd_4
Employé    | jean.dupont@example.com      | hash_pwd_2
Employé    | marie.leroy@example.com      | hash_pwd_3
Employé    | claire.moreau@example.com    | hash_pwd_5
```

---

##  Fonctionnalités RH Implémentées

### 1️⃣ Voir toutes les demandes en attente

**Route:** `GET /rh`

-  Affiche un tableau complet des demandes de congé non traitées
-  Colonnes : Employé, Type, Période, Durée, Motif, Statut, Actions
-  Actualisation des données en temps réel

### 2️⃣ Approuver ou Refuser une demande

**Routes:**
- `POST /rh/approve/:id` - Approuve et met à jour le solde
- `POST /rh/refuse/:id` - Refuse avec commentaire optionnel

**Features :**
-  Boutons d'action pour chaque demande en attente
-  Modal de refus avec champ de commentaire
-  Confirmation avant approbation

### 3️⃣ Mise à jour automatique du solde

Lorsqu'une demande est **approuvée** :
-  Les jours pris sont automatiquement ajoutés aux soldes
-  Calcul : `jours_pris += nb_jours_congé`
-  Année de référence : 2025 (configurable)

**Exemple :**
```
Claire Moreau : Congé payé 2025
AVANT : 25 attribués, 3 pris, 22 restants
APRÈS approbation de 3 jours : 25 attribués, 6 pris, 19 restants
```

### 4️⃣ Filtrer les demandes

**Routes de filtrage :**
- `GET /rh/filter-statut/en_attente` - Demandes en attente
- `GET /rh/filter-statut/approuvee` - Demandes approuvées
- `GET /rh/filter-statut/refusee` - Demandes refusées

**Filtres disponibles :**
-  Par **statut** (en attente, approuvée, refusée)
-  Par **département** (optionnel, extensible)
-  Tri par date de création décroissant

### Vues supplémentaires RH

**Route:** `GET /rh/soldes`
-  Tableau complet des soldes de tous les employés
-  Affichage : Jours attribués, pris, restants, pourcentage d'utilisation
-  Barre de progression visuelle

**Route:** `GET /rh/employe/:id`
-  Détails d'un employé spécifique
-  Ses soldes pour l'année en cours
-  Historique de ses demandes

---

##  Installation et démarrage

### Prérequis
- PHP 8.0+
- Composer
- SQLite (inclus dans PHP)

### Installation


L'application sera accessible à : **http://localhost:8080**

### Configuration

**Base URL** - Modifier si nécessaire dans `app/Config/App.php` :
```php
public string $baseURL = 'http://localhost:8080/';
```

---

##  Structure des fichiers

```
.
├── app/
│   ├── Config/
│   │   ├── App.php              # Configuration principale
│   │   ├── Routes.php           # Définition des routes
│   │   ├── Filters.php          # Filtres de sécurité
│   │   └── Database.php         # Connexion à la base
│   ├── Controllers/
│   │   ├── Auth.php             # Authentification
│   │   ├── RH.php               # Gestion RH des demandes
│   │   ├── EmployeController.php # Demandes employés
│   │   └── Admin.php            # Administration
│   ├── Models/
│   │   ├── Employee.php         # Modèle Employé
│   │   ├── Conge.php           # Modèle Demande
│   │   └── Solde.php           # Modèle Solde
│   └── Views/
│       ├── login/login.php
│       ├── rh/
│       │   ├── dashboard.php
│       │   ├── soldes.php
│       │   └── demandes-employe.php
│       ├── employe/
│       └── admin/
├── public/
│   ├── index.php
│   ├── assets/
│   │   ├── bootstrap/
│   │   ├── css/
│   │   │   ├── fonts.css        # Polices offline
│   │   │   └── login.css
│   │   └── js/
├── writable/
│   ├── database.sql             # Base de données SQLite
│   ├── logs/
│   └── cache/
└── README.md
```

---

##  Points techniques importants

### Sécurité

- **Hachage des mots de passe** : bcrypt (`PASSWORD_DEFAULT`)
- **CSRF Token** : Inclus dans tous les formulaires
- **Session-based auth** : Vérification de la session dans chaque route protégée
- **Validation d'entrées** : Trim, htmlspecialchars, validation côté serveur

### Modèles : Méthodes principales

#### Employee Model

```php
$employee = new Employee();
$employee->getByEmail($email);           // Trouver par email
$employee->getActiveByEmail($email);     // Actif uniquement
$employee->getById($id);                 // Par ID
```

#### Conge Model

```php
$conge = new Conge();
$conge->getPendingDemandes();            // Demandes en attente
$conge->getPendingDemandesWithDetails(); // Avec employé + type
$conge->getByStatut('approuvee');        // Filtre par statut
$conge->approveDemande($id, $rhId);      // Approuver
$conge->refuseDemande($id, $rhId, $comment); // Refuser
```

#### Solde Model

```php
$solde = new Solde();
$solde->getSoldeEmploye($emp_id, 2025);  // Soldes d'un employé
$solde->updateJoursPris($emp_id, $type_id, 2025, $nb_jours); // MAJ
$solde->getAllSoldes(2025);               // Tous les soldes
```

---

##  Interface utilisateur

### Thème

- **Couleurs primaires** : Vert forêt (#2d5a3d), succès (#1e6b3f)
- **Polices** : DM Sans (sans-serif), Georgia (serif fallback)
- **Framework CSS** : Bootstrap 5
- **Icons** : Bootstrap Icons

### Composants

- Tables avec tri et filtrage
- Modales pour les actions confirmées
- Alerts/Toasts pour les messages
- Sidebar de navigation pour RH
- Barres de progression pour les soldes
