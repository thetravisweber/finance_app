<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function create()
    {
        Budget::create([
            'name' => request('name'),
            'description' => request('description')
        ]);
    }
}
