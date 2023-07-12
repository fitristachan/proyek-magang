<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class usersModel extends Model
{
    // Table
    protected $table = 'users';
    protected $primaryKey = "user_id";
    // allowed fields to manage
    protected $allowedFields = ['nim', 'password', 'role_id'];

}