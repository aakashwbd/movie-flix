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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name')->nullable();
            $table->string('web_version')->nullable();
            $table->json('image')->nullable();
            $table->string('copyright')->nullable();
            $table->string('email')->nullable();
            $table->json('social')->nullable();
            $table->json('help')->nullable();
            $table->json('age')->nullable();
            $table->json('partner_site')->nullable();
            $table->json('legal_information')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
