<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('vehicle_number');
            $table->string('remain_vehicle_number');
            $table->string('attachments');
            $table->boolean('is_approved')->default(0);
            $table->integer('approved_by')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('vehicle_attachments');
    }
}
