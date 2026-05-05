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
            $table->string('type_header', 100)->nullable()->after('is_active'); // Menambahkan kolom setelah is_active
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_surat', function (Blueprint $table) {
            $table->dropColumn('type_header'); // Menghapus kolom jika rollback
        });
    }
};