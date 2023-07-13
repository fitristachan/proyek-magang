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
    function result($id = null){
        $calc = new CalculationModel();
        $data = $calc->getInternshipsAndScores($id);
        // SALARY DISTANCE WORKHR TRANSPORT
        $cweight = [0.32,0.13,0.25, 0.3];
        $isbenefit = [true,true,false,false];
        //Dapetin matriks alternatif
        $ids = [];
        $matrix = [[]];
        $i = 0;
        foreach($data as $d){
            $ids[$i] = $d->internship_id;
            $salary = $d->salary;
            $distance = $d->distance;
            $workhour = $d->work_hour;
            $transportfee = $d->transport_fee;

            $matrix[$i] = [$salary, $distance, $workhour, $transportfee];
            $i++;
        }
        $max = [0.0,0.0,0.0,0.0];
        $min = [PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX];
        //NORMALISASI
        $normalized = [[]];
        for($k = 0; $k < 4; $k++){
            for($b = 0; $b < count($matrix); $b++){
                if($matrix[$b][$k] > $max[$k]){
                    $max[$k] = $matrix[$b][$k];
                }
                if($matrix[$b][$k] < $min[$k]){
                    $min[$k] = $matrix[$b][$k];
                }
            }
        }
        for($k = 0; $k < 4; $k++){
            for($b = 0; $b < count($matrix); $b++){
                if($isbenefit[$k]){
                    $normalized[$b][$k] = $matrix[$b][$k] / $max[$k];
                }else{
                    $normalized[$b][$k] = $min[$k] / $matrix[$b][$k];
                }
            }
        }
        
        //HASIL
        $hasil = [];
        for($b = 0; $b < count($normalized); $b++){
            $hasil[$b] = 0;
            for($k = 0; $k<4; $k++){
                $hasil[$b] += $normalized[$b][$k] * $cweight[$k];
            }
        }
        
        $passed = [
            'data'=>$data,
            'hasil'=> $hasil
        ];
        return view('decision/form_output', $passed);
    }
    function fuzzify($type, $value){
        $weight = 0;
        switch($type){
            case 'distance':
                if($value >= 40){
                    $weight = 11;
                } elseif ($value >= 30){
                    $weight = 11;
                } elseif($value >= 20){
                    $weight = 33;
                }elseif($value >= 0){
                    $weight = 45;
                }
                break;
            case 'salary':
                if($value >= 3000000){
                    $weight = 39;
                } elseif ($value >= 2000000){
                    $weight = 28;
                } elseif($value >= 1000000){
                    $weight = 33;
                }
                break;
            case 'work_hour':
                if($value >= 7){
                    $weight = 6;
                } elseif ($value >= 6){
                    $weight = 33;
                } elseif($value >= 5){
                    $weight = 33;
                } elseif($value >= 4){
                    $weight = 28;
                }
                break;
            
            case 'transport_fee':
                if($value >= 40000){
                    $weight = 5;
                } elseif ($value >= 30000){
                    $weight = 0;
                } elseif($value >= 20000){
                    $weight = 56;
                } elseif($value >= 10000){
                    $weight = 39;
                }
                break;
        }
        return $weight;
    }
}