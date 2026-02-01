<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id');
            $table->integer('type');
            $table->integer('organization_id');
            $table->integer('license_type_id');
            $table->date('issue_date');
            $table->date('expire_date');
            $table->string('tariff_no');
            $table->date('tariff_date');
            $table->string('tariff_amount');
            $table->boolean('status')->default(1);
            $table->string('status_reason')->nullable();
            $table->string('attachment_files');
            $table->boolean('is_printed')->default(0);
            $table->integer('printed_by')->nullable();
            $table->date('printed_at')->nullable();
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
        Schema::dropIfExists('licenses');
    }
}
