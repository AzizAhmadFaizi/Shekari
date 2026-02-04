<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShekariWeaponSerialNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shekari_weapon_serial_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shekari_weapon_id')->constrained('shekari_weapons')->cascadeOnDelete();   
            $table->string('serial_number');
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
        Schema::dropIfExists('shekari_weapon_serial_numbers');
    }
}
