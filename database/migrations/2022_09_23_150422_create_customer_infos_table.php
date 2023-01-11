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
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();
            $table->boolean('cus_add_status')->default(0);
            $table->string('customer_address')->nullable();
            $table->string('customer_street_name')->nullable();
            $table->string('customer_street_number')->nullable();
            $table->string('customer_apt')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_zip')->nullable();
            $table->string('gender')->nullable();
            $table->string('c_cc')->nullable();
            $table->string('c_card_exp')->nullable();
            $table->string('c_cvv')->nullable();
            $table->string('c_payment_zip')->nullable();
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
        Schema::dropIfExists('customer_infos');
    }
};
