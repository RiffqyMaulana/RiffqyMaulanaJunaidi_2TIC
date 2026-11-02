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
        Schema::table('cv_profile', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('peran'); // Menambah kolom foto
        });
    }

    public function down(): void
    {
        Schema::table('cv_profile', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
