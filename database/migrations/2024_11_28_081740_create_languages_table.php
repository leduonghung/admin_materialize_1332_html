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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name','50');
            $table->string('canonical')->unique();
            $table->string('flag',5)->unique();
            $table->string('image')->nullable();
            $table->tinyInteger('publish')->default(1);
            $table->tinyInteger('current')->default(0);
            $table->float('order')->default(0)->nullable();
            $table->bigInteger('userCreated');
            $table->bigInteger('userUpdated');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
