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
        Schema::create('book_loans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedbiginteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
            $table->unsignedbiginteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->ondelete('cascade');
            $table->timestamp('loan_date')->useCurrent();
            $table->timestamp('due_date')->useCurrent();
            $table->timestamp('return_date')->useCurrent();
            $table->string('extended')->length(11)->nullable();
            $table->timestamp('extension_date')->useCurrent();
            $table->integer('penalty_amount')->length(11)->default(0);
            $table->string('penalty_status', 15)->nullable();
            $table->string('status')->length(11);
            $table->integer('added_by')->length(11)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_loans');
    }
};
