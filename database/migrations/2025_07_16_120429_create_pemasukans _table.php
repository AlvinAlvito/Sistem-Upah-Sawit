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
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->enum('sektor', ['Sektor Timur', 'Sektor Selatan', 'Sektor Utara', 'Sektor Barat']);
            $table->date('tanggal');
            $table->integer('jumlah_buah');
            $table->integer('jarak_lokasi');
            $table->unsignedTinyInteger('cuaca'); // 0-15
            $table->unsignedTinyInteger('kondisi_jalan'); // 0-15
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};
