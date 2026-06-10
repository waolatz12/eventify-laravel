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
        Schema::create('attendee_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->restrictOnDelete();
            $table->string('ticket_code')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('ticket_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendee_tickets');
    }
};
