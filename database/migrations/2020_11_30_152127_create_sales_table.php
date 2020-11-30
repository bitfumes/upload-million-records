<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('Region');
            $table->string('Country');
            $table->string('Item Type');
            $table->string('Sales Channel');
            $table->string('Order Priority');
            $table->string('Order Date');
            $table->string('Order ID');
            $table->string('Ship Date');
            $table->string('Units Sold');
            $table->string('Unit Price');
            $table->string('Unit Cost');
            $table->string('Total Revenue');
            $table->string('Total Cost');
            $table->string('Total Profit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
