<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('hour');
            $table->string('lieu');
            $table->integer('total_tickets');
            $table->integer('available_tickets');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->integer('duration_of_event');
            $table->enum('type', ['online', 'presentiel']);
            $table->enum('verified', ['yes', 'no']);
            $table->enum('status_event', ['auto-accepted', 'needs-acceptation']);
            $table->decimal('ticket_price', 8, 2);
            $table->timestamps();
            $table->softDeletes(); 
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
