<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShekariWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shekari_weapons', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->date('hijri_warada_date')->nullable(); // تاریخ واردات هجری
            // $table->date('qamari_warada_date')->nullable(); // تاریخ واردات قمری
            // $table->date('meladi_warada_date')->nullable(); // تاریخ واردات میلادی
            $table->date('maktoob_date')->nullable(); // تاریخ مکتوب
            $table->integer('maktoob_number')->nullable(); // شماره مکتوب
            $table->integer('invoice_number')->nullable(); // شماره انوائس
            $table->integer('airo_bill_number')->nullable(); // شماره ایرو بیل
            $table->string('warada_way')->nullable(); // د واردولو لار
            $table->string('tarofa')->nullable(); // تعرفه
            $table->string('type')->nullable(); // نوعیت
            $table->integer('quantity')->nullable(); // تعداد
            $table->integer('fess')->nullable(); // فیس
            $table->integer('revenue')->nullable(); // درآمد (تعداد x فیس)
             $table->string('attachment')->nullable();
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
        Schema::dropIfExists('shekari_weapons');
    }
}
