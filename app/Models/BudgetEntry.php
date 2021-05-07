<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetEntry extends Model
{
    const TABLE_NAME = 'budget_entries';

    protected $fillable = [
        'field',
        'value',
        'row_id'
    ];
}
