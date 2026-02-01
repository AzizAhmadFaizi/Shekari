<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('weapon_quantity');
            $table->string('tariff_no');
            $table->string('tariff_amount');
            $table->date('tariff_date');
            $table->string('attachments');
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
        Schema::dropIfExists('weapon_payments');
    }
}
