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
        Schema::table('rotules', function (Blueprint $table) {
            $table->string('nro_requisicao');
            $table->string('posologia');
            $table->string('formula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rotules', function (Blueprint $table) {
            $table->dropColumn('nro_requisicao');
            $table->dropColumn('posologia');
            $table->dropColumn('formula');
        });
    }
};
