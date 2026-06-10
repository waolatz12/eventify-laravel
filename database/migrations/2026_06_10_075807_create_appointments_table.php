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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attendee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('vendor_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('event_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('appointment_time');

            $table->string('status')
                ->default('pending');

            $table->timestamps();

            $table->index([
                'vendor_id',
                'appointment_time'
            ]);

            $table->index([
                'attendee_id',
                'appointment_time'
            ]);

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
