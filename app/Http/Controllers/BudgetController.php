<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function create()
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Budget::create($data);
    }
}
