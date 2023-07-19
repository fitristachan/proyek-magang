<?php

namespace App\Models;

use CodeIgniter\Model;

class InternshipModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'internships';
    protected $primaryKey       = 'internship_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'salary', 'distance', 'work_hour', 'transport_fee'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
    public function getIntershipsByUserId($user_id)
    {
        return $this->select('internships.internship_id as inter_id, internships.name as internship_name, salary, distance, work_hour, transport_fee')
                ->join('alternative_bind', 'alternative_bind.internship_id = internships.internship_id')
                ->join('calculations as c', 'c.calculation_id = alternative_bind.calculation_id')
                ->join('users', 'users.user_id = c.user_id')
                ->where('users.user_id', $user_id)
                ->groupBy('internships.internship_id') 
                ->findAll();
    }
    public function getInternshipById($internship_id)
    {
        return $this->find($internship_id);
    }
}
