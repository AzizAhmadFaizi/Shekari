<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('vehicle_type');
            $table->boolean('vehicle_owner_id');
            $table->string('plate_no');
            $table->integer('color_id');
            $table->string('engine_no');
            $table->string('shasi_no');
            $table->date('issue_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->integer('vehicle_status_id')->nullable();
            $table->integer('vehicle_attachment_id');
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
        Schema::dropIfExists('vehicles');
    }
}
