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
            Schema::create('information_ebooks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('book_id')->constrained();
                $table->text('title');
                $table->text('small_title');
                $table->text('description');
                $table->json('tags_table');
                $table->date('date');
                $table->string('price');
                $table->text('encrypted_link')->nullable(); // Add encrypted_link column
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_ebooks');
    }
};
