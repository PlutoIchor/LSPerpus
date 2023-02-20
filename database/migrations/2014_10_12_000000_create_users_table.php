<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('kode_user', 25)->unique()->nullable();
            $table->char('nis', 20)->unique()->nullable();
            $table->char('fullname', 125);
            $table->char('username', 50)->unique();
            $table->char('password', 100);
            $table->char('kelas', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('verif', ['verified', 'unverified']);
            $table->enum('role', ['user', 'admin']);
            $table->dateTime('join_date');
            $table->text('foto')->nullable();
            $table->dateTime('terakhir_login')->nullable();
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
        Schema::dropIfExists('users');
    }
}