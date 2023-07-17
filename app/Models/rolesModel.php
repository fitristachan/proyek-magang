<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class rolesModel extends Model
{
    // Table
    protected $table = 'roles';
    protected $primaryKey = "role_id";
    // allowed fields to manage
    protected $allowedFields = ['role_name'];


    function getAll(){
        $builder = $this->db->table('roles');
        $query = $builder->get();
        return $query->getResult();
    }
}