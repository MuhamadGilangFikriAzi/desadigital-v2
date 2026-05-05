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
        Schema::dropIfExists('kondisi_surat_detail');

        Schema::create('kondisi_surat_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('kondisi_surat_id'); // Foreign key to kondisi_surat
            $table->string('tag_surat_detail'); // Foreign key to template_surat_detail
            $table->string('kondisi'); // Condition column
            $table->string('value'); // Value column
            $table->timestamps(); // Created at and updated at columns

            // Foreign key constraints
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kondisi_surat_detail');
    }
};