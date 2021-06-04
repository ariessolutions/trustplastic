<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGRNSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_r_n_s', function (Blueprint $table) {
            $table->id();
            $table->integer('po_id')->nullable();
            $table->integer('location_id');
            $table->string('grn_code');
            $table->string('remark')->nullable();
            $table->tinyInteger('grn_status')->default(1);
            $table->double('grn_total');
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
        Schema::dropIfExists('g_r_n_s');
    }
}
