<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BudgetRow;

class CreateBudgetRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BudgetRow::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('budget_id');
            $table->boolean('is_goal');
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(BudgetRow::TABLE_NAME);
    }
}
