<?php

namespace App\Controllers;

use App\Models\InternshipModel;
use App\Models\CalculationModel;
use App\Models\AlternativeBindModel;
use CodeIgniter\API\ResponseTrait;
use Dompdf\Dompdf;

class SPK extends BaseController
{
    use ResponseTrait;
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
        $this->data['title'] = "Form Input";
        $model = new InternshipModel();
        $uid = $this->session->user_id; //REPLACE SOON
        $inputdata = [];
        $inputdata['internships'] = $model->getIntershipsByUserId($uid);
        
        echo view('templates/header', $this->data);
        echo view('decision/form_input', $inputdata);
        echo view('templates/footer', $this->data);
    }

    public function submit_alternative()
    {
        $json = $this->request->getBody();

        // Decode the JSON data into an associative array
        $data = json_decode($json, true);
        //Ambil new data
        $newAlts = $data['newAlts'];
        $altIDS = $data['existingAlts'];
        foreach ($newAlts as $alt) {
            $internshipModel = new InternshipModel();
            $d = [
                'name' => $alt['name'],
                'salary' => $alt['salary'],
                'distance' => $alt['distance'],
                'work_hour' => $alt['workhour'],
                'transport_fee' => $alt['transport']
            ];
            $internshipModel->insert($d);
            array_push($altIDS, $internshipModel->getInsertID());
        }
        $calculationModel = new CalculationModel();
        $d = [
            'user_id' => $this->session->user_id,
        ];
        $calculationModel->insert($d);
        $calcID = $calculationModel->getInsertID();
        foreach ($altIDS as $id) {
            $altBind = new AlternativeBindModel();
            $dat = [
                'calculation_id' => $calcID,
                'internship_id' => $id
            ];
            $altBind->insert($dat);
        }

        $out = $calcID;
        $this->session->setFlashdata('success', 'Calculations Done Successfully!');
        return $this->response->setJSON(['success' => true, 'data' => $out]);
    }

    public function result($id = null)
    {
        $calc = new CalculationModel();
        $data = $calc->getInternshipsAndScores($id);
        $cweight = [0.32, 0.13, 0.25, 0.3];
        $isbenefit = [true, true, false, false];

        $matrix = [];

        foreach ($data as $d) {
            $ids[] = $d->internship_id;
            $salary = $d->salary;
            $distance = $d->distance;
            $workhour = $d->work_hour;
            $transportfee = $d->transport_fee;

            $matrix[] = [$salary, $distance, $workhour, $transportfee];
        }

        $max = [0.0, 0.0, 0.0, 0.0];
        $min = [PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX];
        $normalized = [[]];
        for ($k = 0; $k < 4; $k++) {
            for ($b = 0; $b < count($matrix); $b++) {
                if ($matrix[$b][$k] > $max[$k]) {
                    $max[$k] = $matrix[$b][$k];
                }
                if ($matrix[$b][$k] < $min[$k]) {
                    $min[$k] = $matrix[$b][$k];
                }
            }
        }
        for ($k = 0; $k < 4; $k++) {
            for ($b = 0; $b < count($matrix); $b++) {
                if ($isbenefit[$k]) {
                    $normalized[$b][$k] = $matrix[$b][$k] / $max[$k];
                } else {
                    $normalized[$b][$k] = $min[$k] / $matrix[$b][$k];
                }
            }
        }

        $hasil = [];
        for ($b = 0; $b < count($normalized); $b++) {
            $hasil[$b] = 0;
            for ($k = 0; $k < 4; $k++) {
                $hasil[$b] += $normalized[$b][$k] * $cweight[$k];
            }
        }

        $passed = [
            'data' => $data,
            'hasil' => $hasil,
        ];

        $pdfUrl = site_url("generate-pdf?id=$id");

        $this->data['title'] = "Decision Result";
        echo view('templates/header', $this->data);
        echo view('decision/form_output', compact('data', 'hasil', 'pdfUrl'));
        echo view('templates/footer', $this->data);
    }

    public function generatePDF($id = null)
    {
        $id = $this->request->getVar('id');
        $calc = new CalculationModel();
        $data = $calc->getInternshipsAndScores($id);

        $cweight = [0.32, 0.13, 0.25, 0.3];
        $isbenefit = [true, true, false, false];

        $matrix = [];

        foreach ($data as $d) {
            $ids[] = $d->internship_id;
            $salary = $d->salary;
            $distance = $d->distance;
            $workhour = $d->work_hour;
            $transportfee = $d->transport_fee;

            $matrix[] = [$salary, $distance, $workhour, $transportfee];
        }

        $max = [0.0, 0.0, 0.0, 0.0];
        $min = [PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX];
        $normalized = [[]];
        for ($k = 0; $k < 4; $k++) {
            for ($b = 0; $b < count($matrix); $b++) {
                if ($matrix[$b][$k] > $max[$k]) {
                    $max[$k] = $matrix[$b][$k];
                }
                if ($matrix[$b][$k] < $min[$k]) {
                    $min[$k] = $matrix[$b][$k];
                }
            }
        }
        for ($k = 0; $k < 4; $k++) {
            for ($b = 0; $b < count($matrix); $b++) {
                if ($isbenefit[$k]) {
                    $normalized[$b][$k] = $matrix[$b][$k] / $max[$k];
                } else {
                    $normalized[$b][$k] = $min[$k] / $matrix[$b][$k];
                }
            }
        }

        $hasil = [];
        for ($b = 0; $b < count($normalized); $b++) {
            $hasil[$b] = 0;
            for ($k = 0; $k < 4; $k++) {
                $hasil[$b] += $normalized[$b][$k] * $cweight[$k];
            }
        }

        $passed = [
            'data' => $data,
            'hasil' => $hasil,
        ];

        $html = view('print/pdf_template', $passed);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Configure Dompdf settings
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('form_output.pdf', ['Attachment' => false]);
    }
    public function getInternshipById($internship_id)
    {
        $internshipModel = new InternshipModel();
        $internship = $internshipModel->getInternshipById($internship_id);

        if ($internship) {
            return $this->respond($internship); // Respond with JSON data containing the internship details.
        } else {
            $this->session->setFlashdata('error', 'Internship not found');
            return $this->failNotFound('Internship not found.'); // Respond with an error status if the internship is not found.
        }
    }

}
