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
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('organizer_id')->constrained('users')->restrictOnDelete()->after('id'); //restrictOnDelete to prevent deletion of user if they have events
            $table->foreignId('venue_id')->nullable()->constrained('venues')->nullOnDelete()->after('organizer_id'); //nullOnDelete to set venue_id to null if the venue is deleted
            $table->string('slug')->unique()->after('title');
            $table->string('goal')->nullable();
            $table->string('theme')->nullable();
            $table->string('format')->default('virtual'); //virtual, in-person, hybrid
            $table->longText('description')->nullable()->change();
            $table->unsignedInteger('capacity')->default(0);
            $table->text('target_audience')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->index('organizer_id');
            $table->index('venue_id');
            $table->index('status');
            $table->index('start_date');
            $table->index(['status', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_organizer_id_foreign');
            $table->dropForeign('events_venue_id_foreign');
            $table->dropColumn(['organizer_id', 'venue_id', 'slug', 'goal', 'theme', 'format', 'capacity', 'target_audience', 'start_date', 'end_date']);
            $table->dropIndex('events_organizer_id_index');
            $table->dropIndex('events_venue_id_index');
            $table->dropIndex('events_status_index');
            $table->dropIndex('events_start_date_index');
            $table->dropIndex('events_status_start_date_index');
        });
    }
};
