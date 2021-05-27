<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoHasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_has_items', function (Blueprint $table) {
            $table->id();
            $table->integer('po_id');
            $table->integer('item_id');
            $table->double('qty');
            $table->double('unit_price', 10,2);
            $table->double('sub_tot', 10,2);
            $table->double('discount', 4,2)->nullable();
            $table->double('vat', 4,2)->nullable();
            $table->double('net_tot', 8,2);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('po_has_items');
    }
}
