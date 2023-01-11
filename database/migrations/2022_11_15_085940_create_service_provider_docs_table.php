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
        Schema::create('service_provider_docs', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();
            $table->boolean('doc_add_status')->default(0);
            $table->string('b_ein')->nullable();
            $table->boolean('b_ein_status')->default(0);
            $table->string('b_certificate')->nullable();
            $table->boolean('b_certificate_status')->default(0);
            $table->string('b_registration')->nullable();
            $table->boolean('b_registration_status')->default(0);
            $table->string('nail_salon')->nullable();
            $table->boolean('nail_salon_status')->default(0);
            $table->string('e_certificate')->nullable();
            $table->boolean('e_certificate_status')->default(0);
            $table->string('b_insurance')->nullable();
            $table->boolean('b_insurance_status')->default(0);
            $table->string('b_workers')->nullable();
            $table->boolean('b_workers_status')->default(0);
            $table->string('driver_license')->nullable();
            $table->boolean('driver_license_status')->default(0);
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
        Schema::dropIfExists('service_provider_docs');
    }
};
