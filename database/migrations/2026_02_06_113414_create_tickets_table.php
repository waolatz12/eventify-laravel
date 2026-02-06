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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('venue')->nullable();
            $table->string('description')->nullable();
            $table->enum('type', ['general', 'vip', 'early_bird'])->default('general');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedBigInteger('ticket_number')->default(0);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
