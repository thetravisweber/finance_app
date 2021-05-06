<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetRow extends Model
{

    const TABLE_NAME = 'budget_rows';

    protected $fillable = [
        'budget_id'
    ];
}