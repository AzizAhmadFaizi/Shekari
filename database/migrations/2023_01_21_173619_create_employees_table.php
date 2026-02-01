<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('employee_attachment_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('national_id');
            $table->string('position');
            $table->boolean('nationality');
            $table->string('attachments');
            $table->boolean('employee_status_id')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
