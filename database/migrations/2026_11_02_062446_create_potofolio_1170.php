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
        Schema::create('cv_profile', function (Blueprint $table) {
            $table->increments('cv_id');
            $table->string('nama', 150);
            $table->string('peran', 100)->default('UI/UX Designer');
            $table->text('tentang_saya')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->unique();
            $table->string('lokasi', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('cv_pendidikan', function (Blueprint $table) {
            $table->increments('pendidikan_id');
            $table->unsignedInteger('cv_id');
            $table->string('gelar');
            $table->string('institusi');
            $table->string('tahun', 30);
            $table->string('ipk', 10)->nullable();
            $table->foreign('cv_id')->references('cv_id')->on('cv_profile')->onDelete('cascade');
        });

        Schema::create('cv_pengalaman', function (Blueprint $table) {
            $table->increments('pengalaman_id');
            $table->unsignedInteger('cv_id');
            $table->string('posisi');
            $table->string('perusahaan');
            $table->string('periode');
            $table->text('deskripsi'); 
            $table->foreign('cv_id')->references('cv_id')->on('cv_profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_pengalaman');
        Schema::dropIfExists('cv_pendidikan');
        Schema::dropIfExists('cv_profile');
    }
};
