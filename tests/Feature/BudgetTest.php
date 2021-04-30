<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BudgetTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_budget_can_be_created()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('new-budget', [
            'name' => 'test-budget',
            'description' => 'this is a test budget, for testing'
        ]);

        $response->assertOk();

        // $this->assertCount(1, Budget::all());
    }
}
