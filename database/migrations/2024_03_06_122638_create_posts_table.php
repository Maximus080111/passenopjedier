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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('dog_name');
            $table->string('message');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price', 4, 2); // Adjust precision as needed
            $table->string('species');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->boolean('is_review')->default(false);  
            $table->string('review')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
