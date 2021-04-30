<?php

namespace Tests\Feature;

use App\Models\Budget;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BudgetTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_budget_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('new-budget', [
            'name' => 'test-budget',
            'description' => 'this is a test budget, for testing'
        ]);

        $response->assertOk();

        $this->assertCount(1, Budget::all());
    }

    public function test_a_name_is_required() 
    {
        $this->withoutExceptionHandling();

        $response = $this->post('new-budget', [
            'name' => '',
            'description' => 'this is a test budget, for testing'
        ]);

        $response->assertSessionHasErrors('name');
    }
}
