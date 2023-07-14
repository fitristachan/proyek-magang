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

    public function viewUser()
    {
        $this->data['list'] = $this->users_model->orderBy('code_book ASC')->select('*')->getUsersRoles();
        echo view('templates/header');
        echo view('auth/viewUser', $this->data);
        echo view('templates/footer');
    }

    public function addUser()
    {
        $this->data['request'] = $this->request;
        $this->data['list'] = $this->users_model->orderBy('code_book ASC')->select('*')->getUsersRoles();
        echo view('templates/header');
        echo view('auth/addUser', $this->data);
        echo view('templates/footer');
    }

    public function saveUser(){
        $this->data['request'] = $this->request;
        $post = [             
            'nim' => $this->request->getPost('nim'),
            'role_id' => $this->request->getPost('role_id'),
        ];
        if(!empty($this->request->getPost('user_id'))){
            $save = $this->users_model->where(['user_id'=>$this->request->getPost('user_id')])->set($post)->update();
        }else{
            if (!$this->validate([
                'nim' => [
                    'rules' => 'required|min_length[5]|max_length[10]|is_unique[users.user_id]',
                'errors' => [
                    'required' => '{field} Must be field',
                    'min_length' => '{field} Minimum length 5 character',
                    'max_length' => '{field} Maximum length 10 character',
                    'is_unique' => 'nim already exists'
                    ]
                    ],
                ],
                )) {
                session()->setFlashdata('error_message', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $save = $this->users_model->insert($post);}
        if($save){
            if(!empty($this->request->getPost('user_id')))
            $this->session->setFlashdata('success_message','Data has been updated successfully') ;
            else
            $this->session->setFlashdata('success_message','Data has been added successfully') ;
            $id =!empty($this->request->getPost('user_id')) ? $this->request->getPost('user_id') : $save;
            return redirect()->to('auth/viewUser');
        }else{
            echo view('templates/header', $this->data);
            echo view('auth/addUser', $this->data);
            echo view('templates/footer');
    }
}

public function editUser($user_id=''){
    if(empty($user_id)){
        $this->session->setFlashdata('error_message','Unknown Data ID.') ;
        return redirect()->to('/auth/viewUser');
    }
    $qry= $this->users_model->select('*')->where(['user_id'=>$user_id]);
    $this->data['data'] = $qry->first();
    echo view('templates/header', $this->data);
    echo view('auth/editUser', $this->data);
    echo view('templates/footer');
}

public function deleteUser($user_id=''){
    if(empty($user_id)){
        $this->session->setFlashdata('error_message','Unknown Data ID') ;
        return redirect()->to('/auth/viewUser');
    }
    $delete = $this->users_model->delete($user_id);
    if($delete){
        $this->session->setFlashdata('success_message','User Details has been deleted successfully.') ;
        return redirect()->to('/auth/viewUser');
    }
}
}
?>