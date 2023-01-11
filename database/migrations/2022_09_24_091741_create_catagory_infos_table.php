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
        Schema::create('catagory_infos', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();  //u_id  == user->id
            $table->string('catagory_name')->nullable();
            $table->string('c_description')->nullable();
            $table->boolean('c_status')->default(0);
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
        Schema::dropIfExists('catagory_infos');
    }
};
