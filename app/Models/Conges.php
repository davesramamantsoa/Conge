<?php

namespace App\Models;

use CodeIgniter\Model;
use Override;

class Conges extends Model
{
    protected $table = 'conges';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'employe_id', 'type_conge_id', 'date_debut', 'date_fin', 'nb_jours', 'motif', 'statut', 'commentaire_rh', 'created_at', 'traite_par'];


    public function findAllwithdetails(int $limit = 0, int $offset = 0)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('conges.*, employes.nom as nom, employes.prenom as prenom, types_conge.libelle as type_conge');
        $builder->join('employes', 'employes.id = conges.employe_id');
        $builder->join('types_conge', 'types_conge.id = conges.type_conge_id');

        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }

        return $builder->get()->getResultArray();
    }

    public function countCongeByMonth()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select("
        strftime('%Y-%m', date_debut) as mois,
        COUNT(*) as total
    ");

        $builder->groupBy("mois");
        $builder->orderBy("mois", "ASC");

        return $builder->get()->getResultArray();
    }
    public function countCongeByWeekday()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select("
        strftime('%w', date_debut) as jour_num,
        COUNT(*) as total
    ");

        $builder->groupBy("jour_num");
        $builder->orderBy("jour_num", "ASC");

        return $builder->get()->getResultArray();
    }
    public function findwithdetailsByEmploye(int $idEmployee)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $idEmployee = (int) $idEmployee;
        $builder->select('conges.*, employes.nom as nom, employes.prenom as prenom, types_conge.libelle as type_conge');
        $builder->join('employes', 'employes.id = conges.employe_id');
        $builder->join('types_conge', 'types_conge.id = conges.type_conge_id');
        $builder->where('employes.id', $idEmployee);

        return $builder->get()->getResultArray();
    }
    #[Override]
    public function find($id = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('conges.*, employes.nom as nom, employes.prenom as prenom, types_conge.libelle as type_conge');
        $builder->join('employes', 'employes.id = conges.employe_id');
        $builder->join('types_conge', 'types_conge.id = conges.type_conge_id');

        if ($id === null) {
            return $builder->get()->getResultArray();
        }
        return $builder->where('conges.id', $id)->get()->getRow();
    }

    public function delete($id = null, bool $purge = false)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        return $builder->delete(['id' => $id]);
    }
}
