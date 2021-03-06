<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\BudgetEntry;
use App\Models\BudgetRow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BudgetTest extends TestCase
{
    use RefreshDatabase;

    const BASIC_ADD_REQUEST = [
        'name' => 'Test Budget',
        'description' => 'This is a test budget, used for testing'
    ];
    // duplicate stored here so that tests can check if url changes
    const ADD_URL = 'budget/add';

    public function test_a_budget_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post(self::ADD_URL, self::BASIC_ADD_REQUEST);

        $response->assertOk();

        $this->assertCount(1, Budget::all());
    }

    public function test_a_name_is_required() 
    {
        $this->test_requirement('name');
    }

    public function test_a_description_is_required() 
    {
        $this->test_requirement('description');
    }

    /* Helper Functions */
    private function test_requirement(string $requirement)
    {
        $request = self::BASIC_ADD_REQUEST;
        $request[$requirement] = null;

        $response = $this->post(self::ADD_URL, $request);

        $response->assertSessionHasErrors($requirement);
    }
}
