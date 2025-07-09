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
            Schema::table('tontine_user', function (Blueprint $table) {
                $table->string('statut')->default('en_attente')->after('tontine_id');
            });
        }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
            Schema::table('tontine_user', function (Blueprint $table) {
                $table->dropColumn('statut');
            });
        }
};
