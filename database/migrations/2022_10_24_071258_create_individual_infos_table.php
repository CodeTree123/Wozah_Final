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
        Schema::create('individual_infos', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();
            $table->boolean('doc_add_status')->default(0);
            $table->string('i_street_number')->nullable();
            $table->string('i_street_name')->nullable();
            $table->string('i_apt')->nullable();
            $table->string('i_city')->nullable();
            $table->string('i_state')->nullable();
            $table->string('i_zip')->nullable();
            $table->string('i_driver_license')->nullable();
            $table->boolean('i_driver_license_status')->default(0);
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
        Schema::dropIfExists('individual_infos');
    }
};
