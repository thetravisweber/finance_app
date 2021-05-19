<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\BudgetEntry;
use App\Models\BudgetRow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BudgetRowTest extends TestCase
{

    use RefreshDatabase;

    public function test_a_budget_row_set_is_ok()
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $first = Budget::first();

        $request = [
            'food' => 40,
            'fun' => 35,
            'Vacation Savings' => 20
        ];

        $response = $this->post("budget/$first->id/add-row", $request);

        $response->assertOk();
    }

    // public function test_a_budget_row_is_created_when_a_budget_row_is_set()
    // {
    //     $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

    //     $response->assertOk();

    //     $first = Budget::first();

    //     $request = [
    //         'food' => 50,
    //         'fun' => 25,
    //         'Vacation Savings' => 10
    //     ];

    //     $response = $this->post("budget/$first->id/set-row", $request);

    //     $response->assertOk();

    //     $this->assertCount(1, BudgetRow::all());
    // }

    // public function test_budget_entries_are_created_when_a_row_is_set()
    // {
    //     $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

    //     $response->assertOk();

    //     $first = Budget::first();

    //     $request = [
    //         'food' => 50,
    //         'fun' => 25,
    //         'Vacation Savings' => 10
    //     ];

    //     $response = $this->post("budget/$first->id/set-row", $request);

    //     $response->assertOk();

    //     $this->assertCount(count($request), BudgetEntry::all());
    // }

    // public function test_get_row_route_is_ok()
    // {
    //     $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

    //     $response->assertOk();

    //     $first = Budget::first();

    //     $addRequest = [
    //         'food' => 50,
    //         'fun' => 25,
    //         'Vacation Savings' => 10
    //     ];

    //     $this->post("budget/$first->id/set-row", $addRequest);

    //     $response = $this->get("budget/$first->id/get-row");

    //     $response->assertOk();
    // }

    // public function test_get_row_is_not_empty()
    // {
    //     $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

    //     $response->assertOk();

    //     $first = Budget::first();

    //     $addRequest = [
    //         'food' => 50,
    //         'fun' => 25,
    //         'Vacation Savings' => 10
    //     ];

    //     $this->post("budget/$first->id/set-row", $addRequest);

    //     $response = $this->get("budget/$first->id/get-row");

    //     $responseData = json_decode($response->content());

    //     $this->assertNotEmpty($responseData);
    // }

    // public function test_row_is_accurate()
    // {
    //     $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

    //     $response->assertOk();

    //     $first = Budget::first();

    //     $addRequest = [
    //         'food' => 50,
    //         'fun' => 25,
    //         'Vacation Savings' => 10
    //     ];

    //     $this->post("budget/$first->id/set-row", $addRequest);

    //     $response = $this->get("budget/$first->id/get-row");

    //     $responseData = json_decode($response->content());

    //     $this->assertEquals($addRequest, (array) $responseData);
    // }

}
