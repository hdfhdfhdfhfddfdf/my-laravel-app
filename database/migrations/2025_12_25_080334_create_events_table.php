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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->date('event_date');
        $table->time('event_time')->default('09:00:00'); // Added Time
        $table->string('venue')->default('Main Auditorium'); // Added Venue
        $table->string('image')->nullable(); // Added Image
        $table->string('category')->default('General'); // Added Category
        $table->decimal('price', 8, 2);
        $table->integer('total_tickets');
        $table->integer('available_tickets');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
