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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();  //u_id  == user->id
            $table->string('subcatagory_id')->nullable();
            $table->string('service_name')->nullable();
            $table->string('s_description')->nullable();
            $table->string('price')->nullable();
            // $table->string('sc_image')->nullable();
            $table->boolean('s_status')->default(0);
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
        Schema::dropIfExists('services');
    }
};
