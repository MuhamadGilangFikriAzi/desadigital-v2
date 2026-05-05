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
        Schema::dropIfExists('kondisi_surat');

        Schema::create('kondisi_surat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('template_surat_id'); // Foreign key to template_surat
            $table->string('logical_operator'); // Logical operator column
            $table->string('code'); // Code column
            $table->string('name'); // Name column
            $table->text('desc'); // Description column
            $table->timestamps(); // Created at and updated at columns

            // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kondisi_surat');
    }
};