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

    /**
     * @test
     * @dataProvider randomBudgetProvider
     */
    public function test_add_a_budget_row_is_ok($request)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $first = Budget::first();

        $response = $this->post("budget/$first->id/add-row", $request);

        $response->assertOk();
    }

    /**
     * @test
     * @dataProvider randomBudgetProvider
     */
    public function test_a_budget_row_is_created_when_a_budget_row_is_added($request)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $response = $this->post("budget/$first->id/add-row", $request);

        $this->assertCount(1, BudgetRow::all());
    }

    /**
     * @test
     * @dataProvider randomBudgetProvider
     */
    public function test_budget_entries_are_created_when_a_row_is_added($request)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $response = $this->post("budget/$first->id/add-row", $request);

        $response->assertOk();

        $this->assertCount(count($request), BudgetEntry::all());
    }

    /**
     * @test
     * @dataProvider randomBudgetProvider
     */
    public function test_list_rows_route_is_ok($addRequest)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

        $this->post("budget/$first->id/add-row", $addRequest);

        $response = $this->get("budget/$first->id/list-rows");

        $response->assertOk();
    }

    /**
     * @test
     * @dataProvider randomBudgetProvider
     */
    public function test_list_rows_is_not_empty_array($addRequest)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $first = Budget::first();

        $this->post("budget/$first->id/add-row", $addRequest);

        $response = $this->get("budget/$first->id/list-rows");

        $responseData = json_decode($response->content());

        $this->assertNotEmpty($responseData);
        $this->assertIsArray($responseData);
    }

    /**
     * @test
     * @dataProvider randomBudgetProvider
     */
    public function test_added_row_is_accurate($addRequest)
    {
        $response = $this->post(BudgetTest::ADD_URL, BudgetTest::BASIC_ADD_REQUEST);

        $response->assertOk();

        $first = Budget::first();

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

        for ($i=0;$i<$runs;$i++) {
            $this->post("budget/$first->id/add-row", $this->randomBudget());
        }

        $this->assertCount($runs, BudgetRow::all());
    }


    public function randomBudgetProvider()
    {
        $results = [];
        for ($i=0;$i<5;$i++) {
            $results[] = [$this->randomBudget()];
        }
        return $results;
    }

    private function randomBudget() 
    {
        return [
            'gas'       =>  random_int(0, 100),
            'food'      =>  random_int(0, 100),
            'vacation'  =>  random_int(0, 100),
            'fun'       =>  random_int(0, 100)
        ];
    }

}
