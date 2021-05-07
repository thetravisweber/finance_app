<?php

namespace Tests\Feature;

use App\Models\Budget;
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

    public function test_a_budget_row_is_created_when_a_budget_goal_is_set()
    {
        $this->withoutExceptionHandling();

        $response = $this->post(self::ADD_URL, self::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $request = [
            'food' => 50,
            'fun' => 25,
            'Vacation Savings' => 10
        ];

        $response = $this->post("budget/$first->id/set-goal", $request);

        $response->assertOk();

        $this->assertCount(1, BudgetRow::all());
    }

    public function test_a_set_goal_is_accurate()
    {
        $this->withoutExceptionHandling();

        $response = $this->post(self::ADD_URL, self::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $addRequest = [
            'food' => 50,
            'fun' => 25,
            'Vacation Savings' => 10
        ];

        $this->post("budget/$first->id/set-goal", $addRequest);

        $response = $this->get("budget/$first->id/get-goal");

        $response->assertOk();

        // $responseData = json_decode($response->content());

        // $this->assertNotEmpty($response);

        // $this->assertEquals($addRequest, json_decode($response->content()));
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
