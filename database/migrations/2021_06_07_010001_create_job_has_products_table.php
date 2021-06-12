<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_has_products', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->integer('bin');
            $table->integer('product');
            $table->double('qty');
            $table->double('cost');
            $table->double('subtotal');
            $table->double('vat');
            $table->double('ex_total');
            $table->double('nettotal');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('job_has_products');
    }
}
