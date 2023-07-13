<?php

namespace App\Controllers;

use App\Models\usersModel;

class Auth extends BaseController
{

    // Session
    protected $session;
    // Data
    protected $data;
    protected $users_model;
 
    // Initialize Objects
    function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->data['request'] = $this->request;
        $this->users_model = new usersModel();
    }

    public function index()
    {
        helper(['form']);
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $nim = $this->request->getVar('nim');
        $password = $this->request->getVar('password');
        $dataUser = $this->users_model->where('nim' , $nim)->first();
        //dd(password_hash('123', PASSWORD_BCRYPT));
        if ($dataUser) {
            $pass = $dataUser['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data=[
                    'user_id' => $dataUser['user_id'],
                    'nim' => $dataUser['nim'],
                    'role_id' => $dataUser['role_id'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/home/beranda');
            } else if ($authenticatePassword == FALSE) {
                session()->setFlashdata('error', 'Wrong password');
                return redirect()->to('/auth/index');
            } 
        }else if ($dataUser == FALSE) {
                session()->setFlashdata('error', 'NIM didnt exists');
                return redirect()->to('/auth/index');
        } 
    }
}
?>