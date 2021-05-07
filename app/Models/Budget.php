<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    const TABLE_NAME = 'budgets';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'name',
        'description'
    ];

    public function setGoal(array $data)
    {
        $goalRow = BudgetRow::create(['budget_id' => $this->id, 'is_goal' => true]);

        return 'succ';
    }

    public function getGoal()
    {
        return [
            'hows_it' => 'good'
        ];
        return BudgetRow::getGoalForBudget($this->id);
    }

}
