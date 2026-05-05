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
        Schema::create('template_surat_attr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('template_surat_id');
            $table->string('attr_code');
            $table->text('attr_value')->nullable();
            $table->string('attr_desc')->nullable();
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
        Schema::dropIfExists('template_surat_attr');
    }
};