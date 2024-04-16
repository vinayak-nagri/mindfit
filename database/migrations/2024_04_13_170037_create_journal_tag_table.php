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
        Schema::create('journal_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journal_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('journal_id')->references('id')->on('journal_entries')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_tag');
    }
};
