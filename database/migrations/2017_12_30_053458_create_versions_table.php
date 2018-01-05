<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('endpoint_id');
            $table->unsignedInteger('comparable_id')->nullable();
            $table->boolean('compare')->default(true);
            $table->text('endpoint_result');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('endpoint_id')->references('id')->on('endpoints');
            $table->foreign('comparable_id')->references('id')->on('versions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versions');
    }
}
