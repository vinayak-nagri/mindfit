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
        Schema::table('habit_tracker', function (Blueprint $table) {
            $table->date('week_start_date')->change();
            $table->date('week_end_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('habit_tracker', function (Blueprint $table) {
            $table->timestamp('week_start_date')->change();
            $table->timestamp('week_end_date')->change();
        });
    }
};
