<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class usersModel extends Model
{
    // Table
    protected $table = 'users';
    protected $primaryKey = "user_id";
    // allowed fields to manage
    protected $allowedFields = ['nim', 'nama', 'password', 'role_id'];


    function getUsersRoles(){
        $builder = $this->db->table('users');
        $builder->join('roles', 'roles.role_id = users.role_id');
        $query = $builder->get();
        return $query->getResult();
    }
}