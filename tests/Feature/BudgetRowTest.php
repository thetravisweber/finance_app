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

    public function test_add_a_budget_row_is_ok()
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

    public function test_a_budget_row_is_created_when_a_budget_row_is_added()
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $request = [
            'food' => 50,
            'fun' => 25,
            'Vacation Savings' => 10
        ];

        $response = $this->post("budget/$first->id/add-row", $request);

        $this->assertCount(1, BudgetRow::all());
    }

    public function test_budget_entries_are_created_when_a_row_is_added()
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $request = [
            'food' => 50,
            'fun' => 25,
            'Vacation Savings' => 10
        ];

        $response = $this->post("budget/$first->id/add-row", $request);

        $response->assertOk();

        $this->assertCount(count($request), BudgetEntry::all());
    }

    public function test_list_rows_route_is_ok()
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $addRequest = [
            'food' => 50,
            'fun' => 25,
            'Vacation Savings' => 10
        ];

        $this->post("budget/$first->id/add-row", $addRequest);

        $response = $this->get("budget/$first->id/list-rows");

        $response->assertOk();
    }

    public function test_list_rows_is_not_empty_array()
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $first = Budget::first();

        $addRequest = [
            'food' => 50,
            'fun' => 25,
            'Vacation Savings' => 10
        ];

        $this->post("budget/$first->id/add-row", $addRequest);

        $response = $this->get("budget/$first->id/list-rows");

        $responseData = json_decode($response->content());

        $this->assertNotEmpty($responseData);
        $this->assertIsArray($responseData);
    }

    public function test_added_row_is_accurate()
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $addRequest = [
            'food' => 5,
            'fun' => 2,
            'Vacation Savings' => 25
        ];

        $this->post("budget/$first->id/add-row", $addRequest);

        $response = $this->get("budget/$first->id/list-rows");

        $responseData = json_decode($response->content());

        $addedRow = reset($responseData);

        $this->assertEquals($addRequest, (array) $addedRow);
    }

    /**
     * @test
     * @dataProvider throughTenProvider
     */
    public function test_multiple_rows_can_be_added($runs)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $addRequest = [
            'food' => 5,
            'fun' => 2,
            'Vacation Savings' => 25
        ];

        for ($i=0;$i<$runs;$i++) {
            $this->post("budget/$first->id/add-row", $addRequest);
        }

        $this->assertCount($runs, BudgetRow::all());
    }

    public function throughTenProvider()
    {
        return $this->genArray(0, 10, 1);
    }

    private function genArray(int $start, int $end, int $inc)
    {
        $results = [];
        for ($i=$start;$i<$end;$i+=$inc) {
            $results[] = [$i];
        }
        return $results;
    }

}
