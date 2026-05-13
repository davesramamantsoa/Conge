<?php

namespace App\Controllers;

use App\Models\LivreModel;
use App\Models\EmpruntModel;
use CodeIgniter\Controller;

class MouvementController extends Controller
{
    protected $livreModel;
    protected $empruntModel;

    public function __construct()
    {
        $this->livreModel = new LivreModel();
        $this->empruntModel = new EmpruntModel();
    }

    // =============================================
    // 6.1 Prêt : Enregistrer un nouvel emprunt
    // =============================================

    /**
     * Enregistre un nouvel emprunt d'un livre.
     * - Vérifie que le livre existe
     * - Vérifie que le livre est disponible
     * - Enregistre l'emprunt avec le nom et la date du jour
     * - Met à jour le statut du livre à "prêté"
     *
     * @param int $livreId L'identifiant du livre
     */
    public function emprunter($livreId)
    {
        // Vérifier que le livre existe
        $livre = $this->livreModel->find($livreId);
        if (!$livre) {
            return redirect()->back()
                           ->with('error', 'Le livre n\'existe pas.');
        }

        // Vérifier que le livre est disponible
        if ($livre['statut'] !== 'disponible') {
            return redirect()->back()
                           ->with('error', 'Ce livre n\'est pas disponible pour l\'emprunt.');
        }

        // Récupérer le nom de l'emprunteur
        $emprunteur = $this->request->getPost('emprunteur');

        // Préparer les données de l'emprunt
        $empruntData = [
            'livre_id'     => $livreId,
            'emprunteur'   => $emprunteur,
            'date_emprunt' => date('Y-m-d'),
            'date_retour'  => null,
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        // Enregistrer l'emprunt
        if ($this->empruntModel->insert($empruntData)) {
            // Mettre à jour le statut du livre à "prêté"
            $this->livreModel->update($livreId, ['statut' => 'prete']);

            return redirect()->back()
                           ->with('success', 'Le livre a été emprunté avec succès par ' . esc($emprunteur) . '.');
        }

        return redirect()->back()
                       ->with('error', 'Une erreur est survenue lors de l\'enregistrement de l\'emprunt.');
    }

    // =============================================
    // 6.2 Retour : Enregistrer le retour d'un livre
    // =============================================

    /**
     * Enregistre le retour d'un livre emprunté.
     * - Retrouve l'emprunt actif (sans date de retour)
     * - Renseigne la date de retour (date du jour)
     * - Remet le statut du livre à "disponible"
     *
     * @param int $livreId L'identifiant du livre
     */
    public function retourner($livreId)
    {
        // Vérifier que le livre existe
        $livre = $this->livreModel->find($livreId);
        if (!$livre) {
            return redirect()->back()
                           ->with('error', 'Le livre n\'existe pas.');
        }

        // Retrouver l'emprunt actif (sans date de retour) pour ce livre
        $empruntActif = $this->empruntModel
                             ->where('livre_id', $livreId)
                             ->where('date_retour IS NULL')
                             ->first();

        if (!$empruntActif) {
            return redirect()->back()
                           ->with('error', 'Ce livre n\'est pas actuellement emprunté.');
        }

        // Renseigner la date de retour (date du jour)
        $dateRetour = date('Y-m-d');
        if ($this->empruntModel->update($empruntActif['id'], ['date_retour' => $dateRetour])) {
            // Remettre le statut du livre à "disponible"
            $this->livreModel->update($livreId, ['statut' => 'disponible']);

            return redirect()->back()
                           ->with('success', 'Le livre a été retourné avec succès. Retour enregistré le ' . $dateRetour . '.');
        }

        return redirect()->back()
                       ->with('error', 'Une erreur est survenue lors de l\'enregistrement du retour.');
    }
}
