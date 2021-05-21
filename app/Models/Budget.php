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
        $this->addRow($data, true);
    }

    public function getGoal()
    {
        $goalRow = new BudgetRow($this->id);

        return $goalRow->getFormattedEntries();
    }

    public function addRow(array $data, bool $isGoal = false)
    {
        $row = BudgetRow::create(['budget_id' => $this->id, 'is_goal' => $isGoal]);

        return $row->enter($data);
    }

    public function listRows()
    {
        $results = [];
        foreach ($this->rows as $row) {
            $results[] = $row->getFormattedEntries();
        }
        return $results;
    }

     // used to describe relationship for Eloquent ORM
     public function rows() 
     {
         return $this->hasMany(BudgetRow::class);
     }

}