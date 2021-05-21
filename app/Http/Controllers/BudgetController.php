<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{

    const API_DIRECTORY = 'budget';

    public function create()
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Budget::create($data);
    }

    public function setGoal(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->setGoal(request()->all());
    }

    public function getGoal(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->getGoal();
    }

    public function addRow(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->addRow(request()->all());
    }

    public function listRows(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->listRows();
    }

}
