<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->string('idpurchasedetails');
            $table->string('idpurchases');
            $table->string('idproducts');
            $table->integer('qty');
            $table->integer('pendapatan');
            $table->double('biaya');
            $table->double('laba');
            $table->enum('payments',['c','t','i']);//cash , transfer, invoice
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by');
            $table->string('updated_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
}
