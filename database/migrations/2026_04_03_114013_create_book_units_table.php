<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('book_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('unit_code')->unique();
            $table->enum('status', ["available", "borowwed", "damaged"])->default('available');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('book_units');
    }
};
