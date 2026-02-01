<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('weapon_type_id');
            $table->string('weapon_no');
            $table->string('weapon_diameter');
            $table->boolean('is_used');
            $table->string('magazine_quantity');
            $table->integer('weapon_status_id')->nullable();
            $table->integer('weapon_attachment_id');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('weapons');
    }
}
