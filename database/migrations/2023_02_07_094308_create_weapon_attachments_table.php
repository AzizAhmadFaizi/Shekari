<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('weapon_number');
            $table->string('remain_weapon_number');
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
        Schema::dropIfExists('weapon_attachments');
    }
}
