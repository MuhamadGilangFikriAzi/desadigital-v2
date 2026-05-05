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
        Schema::create('surat_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('surat_id');
            $table->string('tag', 50);
            $table->string('label', 100);
            $table->string('input_type', 50);

            $table->text('value');
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
        Schema::dropIfExists('surat_detail');
    }
};