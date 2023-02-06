<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_infos', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();
            $table->string('shop_address')->nullable();
            $table->string('b_legal_name')->nullable();
            $table->string('b_dba')->nullable();
            $table->string('street_number_b')->nullable();
            $table->string('street_name_b')->nullable();
            $table->string('apt_b')->nullable();
            $table->string('city_b')->nullable();
            $table->string('state_b')->nullable();
            $table->string('zip_b')->nullable();
            $table->string('street_number_c')->nullable();
            $table->string('street_name_c')->nullable();
            $table->string('apt_c')->nullable();
            $table->string('city_c')->nullable();
            $table->string('state_c')->nullable();
            $table->string('zip_c')->nullable();
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
        Schema::dropIfExists('shop_infos');
    }
};
