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
            $table->string('name');
            $table->string('loginid')->unique();
            $table->string('password');
            $table->integer('device_limit')->default(2);
            $table->boolean('status')->default(true);
            $table->date('expire_date')->nullable();
            $table->enum('role', ['admin', 'operator', 'subscriber']);
            $table->string('cby');
            $table->string('uby')->nullable();
            $table->boolean('is_delete')->default(false);
            $table->rememberToken();
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
