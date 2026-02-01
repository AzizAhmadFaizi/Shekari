<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponPrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_prints', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('weapon_id');
            $table->string('project_name_dr');
            $table->string('card_limit_dr');
            $table->string('project_name_en');
            $table->string('card_limit_en');
            $table->boolean('card_type')->default(1);
            $table->date('issue_date');
            $table->date('valid_date');
            $table->boolean('status')->default(0);
            $table->text('status_reason')->nullable();
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
        Schema::dropIfExists('weapon_prints');
    }
}
