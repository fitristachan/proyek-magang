<?php

namespace App\Controllers;

class SPK extends BaseController
{
    public function index()
    {
        echo view('decision/form_input');
    }
    public function create_spk()
    {


    }
    public function submit_alternative(){
        $alternatives = $this->request->getJSON(true)['alternatives'];

        // Perform any necessary processing or validation on the alternatives

        // Store the alternatives or perform further operations as needed

        // Prepare the data for passing to the next page
        $data = [
            'alternatives' => $alternatives
        ];

        return $this->response->setJSON($data);
    }
}