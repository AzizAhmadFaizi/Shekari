<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVicePresidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vice_presidents', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('name_dr');
            $table->string('name_en')->nullable();
            $table->string('last_name_dr');
            $table->string('last_name_en')->nullable();
            $table->string('father_name')->nullable();
            $table->string('grand_father_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no');
            $table->string('family_contact_no')->nullable();
            $table->string('tin');
            $table->string('nid_pass_no');
            $table->integer('country_id')->nullable();
            $table->integer('permanent_province_id')->nullable();
            $table->integer('permanent_district_id')->nullable();
            $table->string('permanent_village')->nullable();
            $table->string('city')->nullable();
            $table->string('street_no')->nullable();
            $table->string('main_office_address')->nullable();
            $table->integer('current_province_id');
            $table->integer('current_district_id');
            $table->string('current_village')->nullable();
            $table->boolean('status')->default(1);
            $table->string('status_reason')->nullable();
            $table->string('status_attachments')->nullable();
            $table->string('image');
            $table->string('attachments')->nullable();
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
        Schema::dropIfExists('vice_presidents');
    }
}
