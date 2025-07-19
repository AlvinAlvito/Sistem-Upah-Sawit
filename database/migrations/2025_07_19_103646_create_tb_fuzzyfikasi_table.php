<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFuzzyfikasiTable extends Migration
{
    public function up()
    {
        Schema::create('tb_fuzzyfikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');

            // Jumlah buah
            $table->float('jumlah_rendah')->default(0);
            $table->float('jumlah_sedang')->default(0);
            $table->float('jumlah_banyak')->default(0);

            // Jarak lokasi
            $table->float('jarak_dekat')->default(0);
            $table->float('jarak_sedang')->default(0);
            $table->float('jarak_jauh')->default(0);

            // Cuaca
            $table->float('cuaca_cerah')->default(0);
            $table->float('cuaca_mendung')->default(0);
            $table->float('cuaca_hujan')->default(0);

            // Kondisi jalan
            $table->float('jalan_baikk')->default(0);
            $table->float('jalan_sedang')->default(0);
            $table->float('jalan_buruk')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_fuzzyfikasi');
    }
}
