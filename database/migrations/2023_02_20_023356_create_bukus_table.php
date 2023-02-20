<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->char('judul_buku')->unique();
            $table->foreignId('id_kategori')->references('id')->on('kategoris')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_penerbit')->references('id')->on('penerbits')->onUpdate('cascade')->onDelete('cascade');
            $table->char('pengarang', 125);
            $table->integer('tahun_terbit');
            $table->text('foto')->nullable();
            $table->integer('lsbn')->nullable();
            $table->integer('j_buku_baik');
            $table->integer('j_buku_rusak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
