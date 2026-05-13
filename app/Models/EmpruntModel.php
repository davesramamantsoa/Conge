<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpruntModel extends Model
{
    // =============================================
    // 4.1 Configuration du modèle
    // =============================================
    
    protected $table = 'emprunts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'livre_id',
        'emprunteur',
        'date_emprunt',
        'date_retour',
        'created_at'
    ];
    
    // Activer les timestamps automatiques
    protected $useTimestamps = false;  // Désactiver car la table n'a que created_at
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $dateFormat = 'datetime';

    // =============================================
    // Validations
    // =============================================
    
    protected $validationRules = [
        'livre_id'     => 'required|integer|is_not_unique[livres.id]',
        'emprunteur'   => 'required|string|max_length[255]|min_length[2]',
        'date_emprunt' => 'required|valid_date[Y-m-d]',
        'date_retour'  => 'permit_empty|valid_date[Y-m-d]',
    ];

    protected $validationMessages = [
        'livre_id' => [
            'required'       => 'L\'ID du livre est obligatoire.',
            'integer'        => 'L\'ID du livre doit être un nombre.',
            'is_not_unique'  => 'Ce livre n\'existe pas dans la base de données.',
        ],
        'emprunteur' => [
            'required'   => 'Le nom de l\'emprunteur est obligatoire.',
            'string'     => 'Le nom doit être du texte.',
            'max_length' => 'Le nom ne doit pas dépasser 255 caractères.',
            'min_length' => 'Le nom doit avoir au moins 2 caractères.',
        ],
        'date_emprunt' => [
            'required'    => 'La date d\'emprunt est obligatoire.',
            'valid_date'  => 'La date d\'emprunt doit être au format Y-m-d (ex: 2026-04-20).',
        ],
        'date_retour' => [
            'valid_date'  => 'La date de retour doit être au format Y-m-d (ex: 2026-04-20).',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // =============================================
    // 4.2 Méthode retournant le dernier emprunt d'un livre
    // =============================================

    /**
     * Retourne le dernier emprunt d'un livre (le plus récent selon la date d'emprunt)
     *
     * @param int $livreId L'ID du livre
     * @return array|null L'emprunt le plus récent ou null
     */
    public function getDernierEmpruntLivre($livreId)
    {
        return $this->where('livre_id', $livreId)
                    ->orderBy('date_emprunt', 'DESC')
                    ->first();
    }
}
