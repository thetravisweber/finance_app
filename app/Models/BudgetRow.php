<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetRow extends Model
{

    const TABLE_NAME = 'budget_rows';

    protected $fillable = [
        'budget_id',
        'is_goal'
    ];

    public static function getGoalForBudget($budgetId)
    {
        return static::where('budget_id', $budgetId)
                    ->where('is_goal', true)
                    ->where('is_deleted', false)
                    ->first();
    }

    public function enter($data)
    {
        $insertData = [];
        foreach ($data as $key => $val) {
            $insertData[] = [
                'field' => $key,
                'value' => $val,
                'row_id' => $this->id
            ];
        }

        BudgetEntry::insert($insertData);
    }

    public function get() {
        if ($this->is_goal) {
            return 'I am a goal';
        }
        return 'I am not a goal';
    }
}