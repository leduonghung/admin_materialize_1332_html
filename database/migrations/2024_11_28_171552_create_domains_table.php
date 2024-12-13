<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            // $table->string('canonical')->unique();
            $table->integer('language_id')->comment('Ngon ngu');
            $table->integer('domain_extension_id')->comment('Đuôi tên miền');
            $table->date('date_of_registration')->comment('Ngày đăng ký');
            $table->date('expiry_date')->comment('Ngày hết hạn')->nullable();
            $table->integer('year_of_extended')->comment('Số năm gia hạn')->nullable();
            $table->text('content')->nullable();
            $table->string('place_registration')->nullable()->comment('Nơi đăng ký');
            $table->tinyInteger('publish')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->float('order')->default(0)->nullable();
            $table->bigInteger('userCreated');
            $table->bigInteger('userUpdated')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
