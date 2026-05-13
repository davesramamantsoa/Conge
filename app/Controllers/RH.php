<?php

namespace App\Controllers;

use App\Models\Solde;
use App\Models\Employee;
use CodeIgniter\Controller;
use Config\Database;

class RH extends Controller
{
    protected $soldeModel;
    protected $employeeModel;
    protected $session;

    public function __construct()
    {
        $this->soldeModel = new Solde();
        $this->employeeModel = new Employee();
        $this->session = session();
    }

    private function requireRh()
    {
        if (!$this->session->has('user_id') || $this->session->get('user_role') !== 'rh') {
            return redirect()->to('/login')->with('error', 'Accès refusé.');
        }

        return null;
    }

    private function congeBuilder()
    {
        return Database::connect()->table('conges c')
            ->select('c.*, e.nom, e.prenom, e.departement_id, t.libelle as type_conge_libelle')
            ->join('employes e', 'e.id = c.employe_id')
            ->join('types_conge t', 't.id = c.type_conge_id');
    }

    /**
     * Dashboard RH - Voir toutes les demandes (tous statuts)
     */
    public function dashboard()
    {
        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $data = [
            'demandes' => $this->congeBuilder()->orderBy('c.created_at', 'DESC')->get()->getResultArray(),
            'departements' => $this->employeeModel->distinct()->select('departement_id')->findAll(),
        ];

        return view('rh/dashboard', $data);
    }

    /**
     * Filtrer les demandes par département
     */
    public function filterByDepartement($departement_id)
    {
        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $data = [
            'demandes' => $this->congeBuilder()
                ->where('c.statut', 'en_attente')
                ->where('e.departement_id', $departement_id)
                ->orderBy('c.created_at', 'DESC')
                ->get()
                ->getResultArray(),
            'departements' => $this->employeeModel->distinct()->select('departement_id')->findAll(),
            'selected_departement' => $departement_id,
        ];

        return view('rh/dashboard', $data);
    }

    /**
     * Filtrer les demandes par statut
     */
    public function filterByStatut($statut)
    {
        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $data = [
            'demandes' => $this->congeBuilder()
                ->where('c.statut', $statut)
                ->orderBy('c.created_at', 'DESC')
                ->get()
                ->getResultArray(),
            'departements' => $this->employeeModel->distinct()->select('departement_id')->findAll(),
            'selected_statut' => $statut,
        ];

        return view('rh/dashboard', $data);
    }

    /**
     * Approuver une demande de congé
     */
    public function approveDemande($id)
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $db = Database::connect();
        $demande = $db->table('conges')->where('id', $id)->get()->getRowArray();

        if (!$demande) {
            return redirect()->back()->with('error', 'Demande introuvable.');
        }

        $typeConge = $db->table('types_conge')
            ->where('id', $demande['type_conge_id'])
            ->get()
            ->getRowArray();

        // Approuver la demande
        $db->table('conges')->where('id', $id)->update([
            'statut' => 'approuvee',
            'traite_par' => $this->session->get('user_id'),
        ]);

        // Mettre à jour automatiquement le solde uniquement pour les congés déductibles
        if ($typeConge && (int) ($typeConge['deductible'] ?? 1) === 1) {
            $annee = (int) date('Y', strtotime((string) $demande['date_debut']));

            $this->soldeModel->updateJoursPris(
                $demande['employe_id'],
                $demande['type_conge_id'],
                $annee,
                $demande['nb_jours']
            );
        }

        $message = 'Demande approuvée';
        if ($typeConge && (int) ($typeConge['deductible'] ?? 1) === 1) {
            $message .= ' et solde mis à jour';
        }

        return redirect()->back()->with('success', $message . '.');
    }

    /**
     * Refuser une demande de congé
     */
    public function refuseDemande($id)
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $db = Database::connect();
        $demande = $db->table('conges')->where('id', $id)->get()->getRowArray();

        if (!$demande) {
            return redirect()->back()->with('error', 'Demande introuvable.');
        }

        $commentaire = $this->request->getPost('commentaire') ?? '';

        // Refuser la demande
        $db->table('conges')->where('id', $id)->update([
            'statut' => 'refusee',
            'traite_par' => $this->session->get('user_id'),
            'commentaire_rh' => $commentaire,
        ]);

        return redirect()->back()->with('success', 'Demande refusée.');
    }

    /**
     * Voir les soldes de tous les employés
     */
    public function soldes()
    {
        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $data = [
            'soldes' => $this->soldeModel->getAllSoldes(2025),
        ];

        return view('rh/soldes', $data);
    }

    /**
     * Voir les détails des demandes d'un employé
     */
    public function demandesEmploye($employe_id)
    {
        if ($redirect = $this->requireRh()) {
            return $redirect;
        }

        $employee = $this->employeeModel->find($employe_id);
        if (!$employee) {
            return redirect()->back()->with('error', 'Employé introuvable.');
        }

        $data = [
            'employee' => $employee,
            'soldes' => $this->soldeModel->getSoldeEmploye($employe_id, 2025),
            'demandes' => Database::connect()->table('conges c')
                ->select('c.*, t.libelle as type_conge_libelle')
                ->join('types_conge t', 't.id = c.type_conge_id')
                ->where('c.employe_id', $employe_id)
                ->orderBy('c.created_at', 'DESC')
                ->get()
                ->getResultArray(),
        ];

        return view('rh/demandes-employe', $data);
    }
}
