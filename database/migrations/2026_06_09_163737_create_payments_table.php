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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->restrictOnDelete();
            $table->string('reference')->nullable(); //transaction unique identifier
            $table->decimal('amount',10,2)->default(0.00);
            $table->string('gateway')->nullable(); //either flutter, paystack, or anything
            $table->string('status')->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('reference');
            $table->index('gateway');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
