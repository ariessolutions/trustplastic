<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGRNHasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_r_n_has_items', function (Blueprint $table) {
            $table->id();
            $table->double('qty');
            $table->double('unit_price');
            $table->tinyInteger('status');
            $table->integer('item_id');
            $table->integer('grn_id');
            $table->integer('bin_location_id');
            $table->double('discount');
            $table->double('vat');
            $table->double('subtotal');
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
        Schema::dropIfExists('g_r_n_has_items');
    }
}
