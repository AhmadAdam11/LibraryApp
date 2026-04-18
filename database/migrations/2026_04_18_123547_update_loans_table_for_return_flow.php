<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->timestamp('requested_return_at')->nullable()->after('borrowed_at');

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'pending_return',
                'returned'
            ])->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'returned'
            ])->default('pending')->change();

            $table->dropColumn('requested_return_at');
        });
    }
};