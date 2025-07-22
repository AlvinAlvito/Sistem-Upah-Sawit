<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_fuzzies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('pemasukan_id'); // ➕ Kolom baru

            $table->float('nilai_z');             // hasil defuzzifikasi
            $table->float('persentase');          // nilai z dalam persen

            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('pemasukan_id')->references('id')->on('pemasukans')->onDelete('cascade'); // ➕ Foreign key baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_fuzzies');
    }
};
