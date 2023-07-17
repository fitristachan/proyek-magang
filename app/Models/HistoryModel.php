<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'calculations';
    protected $primaryKey       = 'calculation_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['created_at', 'updated_at', 'user_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get calculations with internships for a specific user.
     *
     * @param int $userId
     * @return array
     */
    public function getCalculationsWithInternships($userId)
    {
        $builder = $this->db->table('calculations');
        $builder->select('calculations.*, internships.*, alternative_bind.score')
            ->join('alternative_bind', 'alternative_bind.calculation_id = calculations.calculation_id')
            ->join('internships', 'internships.internship_id = alternative_bind.internship_id')
            ->where('calculations.user_id', $userId);

        $results = $builder->get()->getResult();

        $calculations = [];
        foreach ($results as $result) {
            $calculationId = $result->calculation_id;
            if (!isset($calculations[$calculationId])) {
                $calculations[$calculationId] = (object)[
                    'calculation_id' => $result->calculation_id,
                    'user_id' => $result->user_id,
                    'created_at' => $result->created_at,
                    'internships' => [],
                ];
            }

            $internship = (object)[
                'name' => $result->name,
                'salary' => $result->salary,
                'work_hour' => $result->work_hour,
                'distance' => $result->distance,
                'transport_fee' => $result->transport_fee,
            ];

            $calculations[$calculationId]->internships[] = $internship;
        }

        return array_values($calculations);
    }
}
