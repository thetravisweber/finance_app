<?php

namespace Tests\Unit;

use App\Models\BudgetRow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetRowTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_a_budget_row_can_be_added()
    {
        $created = BudgetRow::create(['budget_id' => 69]);

        $this->assertCount(1, BudgetRow::all());
    }
}
