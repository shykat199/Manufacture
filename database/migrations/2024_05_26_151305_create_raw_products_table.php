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
        Schema::create('raw_products', function (Blueprint $table) {
            $table->id();
            $table->string('name',20);
            $table->string('prefix',20)->nullable();
            $table->integer('price');
            $table->tinyInteger('status')->default(ACTIVE_STATUS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_products');
    }
};
