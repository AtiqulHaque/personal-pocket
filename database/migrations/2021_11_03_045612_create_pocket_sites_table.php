<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePocketSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pocket_sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pocket_id')->unsigned()->nullable();
            $table->foreign('pocket_id')
                ->references('id')
                ->on('pockets')
                ->onDelete('cascade');
            $table->string('site_url', 250);
            $table->boolean('is_scraped')->default(false);
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
        Schema::dropIfExists('pocket_sites');
    }
}
