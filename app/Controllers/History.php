<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class History extends BaseController
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
        $this->data['title'] = "History";
        $historyModel = new HistoryModel();
        $userId = 1; // Replace '1' with the actual user ID
        $calculations = $historyModel->getCalculationsWithInternships($userId);

        echo view('templates/header', $this->data);
        echo view('history/history', ['calculations' => $calculations]);
        echo view('templates/footer', $this->data);
    }
}
