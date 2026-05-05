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
        Schema::table('template_surat', function (Blueprint $table) {
            $table->string('letter_size', 100)->nullable()->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('template_surat', function (Blueprint $table) {
            $table->dropColumn('letter_size');
        });
    }
};