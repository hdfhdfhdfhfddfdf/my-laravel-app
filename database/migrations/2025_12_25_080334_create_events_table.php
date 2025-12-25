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
        $table->decimal('price', 8, 2); // e.g., 50.00
        $table->integer('total_tickets'); // Total capacity
        $table->integer('available_tickets'); // Tickets left
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
