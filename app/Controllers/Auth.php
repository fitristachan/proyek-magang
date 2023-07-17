<?php

namespace App\Controllers;

use App\Models\usersModel;
use App\Models\rolesModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{

    // Session
    protected $session;
    // Data
    protected $data;
    protected $users_model;
    protected $roles_model;
 
    // Initialize Objects
    function __construct(){
        $this->session= \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->data['request'] = $this->request;
        $this->users_model = new usersModel();
        $this->roles_model = new rolesModel();
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
                    'name' => $dataUser['name'],
                    'id' => $dataUser['role_id'],
                    'logged_in' => TRUE
                ];
                $this->session->set($ses_data);
                $this->session->setFlashdata('info', 'Welcome '.$this->session->name.'!');
                return redirect()->to('/home/index');
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
        $this->data['title'] = "View Users";
        $this->data['list'] = $this->users_model->orderBy('code_book ASC')->select('*')->getUsersRoles();
        echo view('templates/header', $this->data);
        echo view('auth/viewUser', $this->data);
        echo view('templates/footer', $this->data);
    }

    public function addUser()
    {
        $this->data['title'] = "Add User";
        $this->data['request'] = $this->request;
        $this->data['roles'] = $this->roles_model->getAll();
        echo view('templates/header', $this->data);
        echo view('auth/addUser', $this->data);
        echo view('templates/footer', $this->data);
    }

    public function saveUser(){
        $myTime = Time::now('Asia/Jakarta', 'en_US');

        if(!empty($this->request->getPost('user_id'))){

            if (!$this->validate([
                'nim' => [
                    'rules' => 'required|min_length[5]|max_length[10]|is_unique[users.nim,users.user_id,'.$this->request->getPost('user_id').']|numeric',
                    'errors' => [
                        'required' => 'NIM Must be field',
                        'min_length' => 'Min NIM length 5 character',
                        'max_length' => 'Max NIM length 10 character',
                        'is_unique' => 'NIM already exists',
                        'numeric' => 'NIM must be numeric'
                    ]
                    ],

                    'password' => [
                        'rules' => 'required|min_length[4]|max_length[50]',
                        'errors' => [
                            'required' => 'Password Must be field',
                            'min_length' => 'Min Password length 4 character',
                            'max_length' => 'Max Password length 50 character',
                        ]
                    ],
                    'confirm_password' => [
                        'rules' => 'matches[password]',
                        'errors' => [
                            'matches' => 'Password did not match',
                        ]
                        ],
                ]
                )) {
                $this->session->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $post = [             
                'nim' => $this->request->getPost('nim'),
                'password'=> password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'updated_at' => $myTime,
                'name' => $this->request->getPost('name'),
                'role_id' => $this->request->getPost('id')
            ];
            $save = $this->users_model->where(['user_id'=>$this->request->getPost('user_id')])->set($post)->update();
        }else{
            if (!$this->validate([
                'nim' => [
                    'rules' => 'required|min_length[5]|max_length[10]|is_unique[users.nim]|numeric',
                    'errors' => [
                        'required' => 'NIM Must be field',
                        'min_length' => 'Min NIM length 5 character',
                        'max_length' => 'Max NIM length 10 character',
                        'is_unique' => 'NIM already exists',
                        'numeric' => 'NIM must be numeric'
                    ]
                    ],

                    'password' => [
                        'rules' => 'required|min_length[4]|max_length[50]',
                        'errors' => [
                            'required' => 'Password Must be field',
                            'min_length' => 'Min Password length 4 character',
                            'max_length' => 'Max Password length 50 character',
                        ]
                    ],
                    'confirm_password' => [
                        'rules' => 'matches[password]',
                        'errors' => [
                            'matches' => 'Password did not match',
                        ]
                        ],
                ]
                )) {
                $this->session->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $post = [             
                'nim' => $this->request->getPost('nim'),
                'password'=> password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'created_at' => $myTime,
                'name' => $this->request->getPost('name'),
                'role_id' => $this->request->getPost('id')
            ];
            $save = $this->users_model->insert($post);}
        if($save){
            if(!empty($this->request->getPost('user_id')))
                $this->session->setFlashdata('success','Data has been updated successfully') ;
            else
                $this->session->setFlashdata('success','Data has been added successfully') ;
                $id =!empty($this->request->getPost('user_id')) ? $this->request->getPost('user_id') : $save;
                return redirect()->to('auth/viewUser');
        }else{
            echo view('templates/header', $this->data);
            echo view('auth/addUser', $this->data);
            echo view('templates/footer', $this->data);
    }
}

public function editUser($user_id=''){
    $this->data['title'] = "Edit User";
    if(empty($user_id)){
        $this->session->setFlashdata('error','Unknown Data ID.') ;
        return redirect()->to('/auth/viewUser');
    }
    $this->data['roles'] = $this->roles_model->getAll();
    $this->data['rolePick'] = $this->users_model->select("*")->where(['user_id'=>$user_id])->join('roles', 'roles.id = users.role_id', 'LEFT')->first();
    $qry= $this->users_model->select('*')->where(['user_id'=>$user_id]);
    $this->data['data'] = $qry->first();
    echo view('templates/header', $this->data);
    echo view('auth/editUser', $this->data);
    echo view('templates/footer',$this->data);
}

public function deleteUser($user_id=''){
    if(empty($user_id)){
        $this->session->setFlashdata('error','Unknown Data ID') ;
        return redirect()->to('/auth/viewUser');
    }
    $delete = $this->users_model->delete($user_id);
    if($delete){
        $this->session->setFlashdata('success','User details has been deleted successfully.') ;
        return redirect()->to('/auth/viewUser');
    }
}

public function logout()
{
    $session = session();
    session()->setFlashdata('info','See you again!');
    $session->destroy();
    return redirect()->to('/auth/index');
}
}
?>