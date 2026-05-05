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
        Schema::dropIfExists('ref_master');
        Schema::dropIfExists('ref_master_type');

        Schema::create('ref_master_type', function (Blueprint $table) {
            $table->string('ref_master_type_code')->primary();
            $table->string('ref_master_type_name');
            $table->boolean('is_option')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ref_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_master_code');
            $table->string('ref_master_name');
            $table->string('ref_master_value');
            $table->string('ref_master_type_code');
            $table->timestamps();

            // Foreign key constraint to ref_master_type (if applicable)
            $table->foreign('ref_master_type_code')->references('ref_master_type_code')->on('ref_master_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_master');
        Schema::dropIfExists('ref_master_type');

    }
};