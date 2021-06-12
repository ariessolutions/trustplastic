<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle');
            $table->integer('location');
            $table->integer('user');
            $table->string('code');
            $table->string('mcode')->nullable();
            $table->string('cost');
            $table->string('remark')->nullable();
            $table->date('approval_date')->nullable();
            $table->integer('approval_user')->nullable();
            $table->integer('status')->default(3);
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
        Schema::dropIfExists('jobs');
    }
}
