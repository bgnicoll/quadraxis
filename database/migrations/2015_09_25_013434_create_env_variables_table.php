<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('version');
            $table->string('key');
            $table->string('value');
            $table->boolean('sensitive');
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
        Schema::drop('env_variables');
    }
}
