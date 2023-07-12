<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class usersModel extends Model
{
    // Table
    protected $table = 'roles';
    protected $primaryKey = "role_id";
    // allowed fields to manage
    protected $allowedFields = ['role_name'];

}