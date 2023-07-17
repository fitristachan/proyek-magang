<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class usersModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    // allowed fields to manage
    protected $allowedFields = ['nim', 'name', 'password', 'created_at', 'updated_at', 'role_id'];

  // Dates
    protected $useTimestamps = false;
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


    function getUsersRoles(){
        $builder = $this->db->table('users');
        $builder->join('roles', 'roles.id = users.role_id');
        $query = $builder->get();
        return $query->getResult();
    }
}