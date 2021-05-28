<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_code');
            $table->integer('supplier_id');
            $table->integer('location_id');
            $table->integer('bin_location_id');
            $table->string('approved_quotation_code')->nullable();
            $table->date('po_date');
            $table->date('po_expected_deliver_date')->nullable();
            $table->double('po_tot',10,2);
            $table->double('discount',4,2)->nullable();
            $table->double('tot_vat',4,2)->nullable();
            $table->double('po_net_tot',10,2);
            $table->string('po_approved_person')->nullable();
            $table->date('po_approved_date')->nullable();
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
