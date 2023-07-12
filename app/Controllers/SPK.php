<?php

namespace App\Controllers;
use App\Models\InternshipModel;
use App\Models\CalculationModel;
use App\Models\AlternativeBindModel;

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
        
        $json = $this->request->getBody();

        // Decode the JSON data into an associative array
        $data = json_decode($json, true);
        //Ambil new data
        $test = "";
        $newAlts = $data['newAlts'];
        $altIDS = [];
        foreach($newAlts as $alt){
            $internshipModel = new InternshipModel();
            $d = [
                'name' => $alt['name'], 
                'salary' => $alt['salary'], 
                'distance'=> $alt['distance'], 
                'work_hour'=> $alt['workhour'],
                'transport_fee'=> $alt['transport']
            ];
            $internshipModel->insert($d);
            array_push($altIDS, $internshipModel->getInsertID());
        }
        $calculationModel = new CalculationModel();
        $d = [
            'user_id'=>1,
        ];
        $calculationModel->insert($d);
        $calcID = $calculationModel->getInsertID();
        foreach($altIDS as $id){
            $altBind = new AlternativeBindModel();
            $dat = [
                'calculation_id' => $calcID,
                'internship_id' => $id
            ];
            $altBind->insert($dat);
        }

        $out = $calcID;
        return $this->response->setJSON(['success' => true, 'calcID'=>1, 'data'=>$out]);
    }
}