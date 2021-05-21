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


    /**
     *  SETTERS
     */
    public function setGoal(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->setGoal(request()->all());
    }

    public function addRow(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->addRow(request()->all());
    }

    /***
     *  GETTERS
     */
    public function getGoal(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->getGoal();
    }

    public function listRows(int $budgetId)
    {
        $budget = new Budget($budgetId);

        return $budget->listRows();
    }

}
