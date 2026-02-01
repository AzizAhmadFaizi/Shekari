<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('contract_reference');
            $table->string('contract_location');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('afghan_employee_number');
            $table->string('foreign_employee_number');
            $table->string('weapon_quantity');
            $table->string('vehicle_quantity');
            $table->string('radio_quantity');
            $table->string('cost');
            $table->string('attachments');
            $table->text('comment')->nullable();
            $table->boolean('status')->default(1);
            $table->string('status_reason')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->integer('approved_by')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
