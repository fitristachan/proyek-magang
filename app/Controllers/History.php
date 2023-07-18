<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class History extends BaseController
{
    public function index()
    {
        $historyModel = new HistoryModel();
        $userId = 1; // Replace '1' with the actual user ID
        $calculations = $historyModel->getCalculationsWithInternships($userId);

        return view('history/history', ['calculations' => $calculations]);
    }
}
