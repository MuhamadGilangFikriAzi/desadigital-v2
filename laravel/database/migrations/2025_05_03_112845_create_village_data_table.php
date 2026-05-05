<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('village_data');

        Schema::create('village_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_chart');
            $table->string('title');
            $table->boolean('is_active')->default(true); // lebih tepat sebagai boolean
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
        Schema::dropIfExists('village_data');
    }
};