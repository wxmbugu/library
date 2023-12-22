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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 200);
            $table->string('publisher', 50);
            $table->string('isbn', 200);
            $table->string('category', 100);
            $table->string('sub_category', 100);
            $table->text('description');
            $table->integer('pages');
            $table->string('image', 200);
            $table->integer('added_by')->length(11)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
