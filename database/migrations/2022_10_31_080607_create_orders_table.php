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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('cus_id')->nullable();
            $table->string('sp_id')->nullable();
            $table->string('address')->nullable();
            $table->string('total_items')->nullable();
            $table->string('total_price')->nullable();
            $table->boolean('order_status')->default(0);
            $table->string('assign_emp_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
