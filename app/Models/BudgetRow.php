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
                'budget_row_id' => $this->id
            ];
        }

        BudgetEntry::insert($insertData);
    }
    
    public function getSummary()
    {
        return [
            'meta_data' => $this->get(),
            'entries'  => $this->getFormattedEntries()
        ];
    }

    public function getFormattedEntries()
    {
        $results = [];
        foreach ($this->rows as $row) {
            $results[$row['field']] = $row['value'];
        }
        return $results;
    }



    // used to describe relationship for Eloquent ORM
    public function rows() 
    {
        return $this->hasMany(BudgetEntry::class);
    }

}