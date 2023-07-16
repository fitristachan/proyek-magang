<?php

namespace App\Controllers;

class Home extends BaseController
{

      // Session
      protected $session;
      // Data
      protected $data;
   
      // Initialize Objects
      function __construct(){
          $this->session= \Config\Services::session();
          $this->data['session'] = $this->session;
          $this->data['request'] = $this->request;
      }

      
    public function index()
    {
        $this->data['title'] = "Home";
        echo view('templates/header', $this->data);
        echo view('home/home', $this->data);
        echo view('templates/footer', $this->data);
    }
}
