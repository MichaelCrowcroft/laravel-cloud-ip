<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloudIPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloud_ips', function (Blueprint $table) {
            $table->id();

            $table->string('ip_prefix')->unique();
            $table->string('first_ip');
            $table->string('last_ip');
            $table->string('type');
            $table->string('provider');
            $table->string('region')->nullable();
            $table->string('service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cloud_ips');
    }
}