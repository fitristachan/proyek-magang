<?php

namespace App\Models;

use CodeIgniter\Model;

class CalculationModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'calculations';
    protected $primaryKey       = 'calculation_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['created_at', 'updated_at', 'user_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Dapetin list magang dari calculationID
     *
     * @param int $calculationId
     * @return array
     */
    public function getInternshipsAndScores($calculationId)
    {
        $builder = $this->db->table('alternative_bind');
        $builder->select('internships.*, alternative_bind.score')
            ->join('internships', 'internships.internship_id = alternative_bind.internship_id')
            ->where('alternative_bind.calculation_id', $calculationId);

        return $builder->get()->getResult();
    }

    /**
     * Dapetin calculation sama list magang dari userId
     *
     * @param int $userId
     * @return array
     */
    public function getCalculationsWithInternships($userId)
    {
        $builder = $this->db->table('calculations');
        $builder->select('calculations.*, internships.*, alternative_bind.score')
            ->join('alternative_bind', 'alternative_bind.calculation_id = calculations.calculation_id')
            ->join('internships', 'internships.internship_id = alternative_bind.internship_id')
            ->where('calculations.user_id', $userId);

        return $builder->get()->getResult();
    }
}
