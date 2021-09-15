<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("invoices", function(Blueprint $table){
            $table->id();
            $table->string("InvoiceNo");
            $table->string("StockCode");
            $table->text("Description")->nullable();
            $table->integer("Quantity");
            $table->datetime("InvoiceDate")->nullable();
            $table->double("UnitPrice")->nullable();
            $table->integer("CustomerID")->nullable();
            $table->string("Country")->nullable();
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
        $table->dropIfExists("invoices");
    }
}
