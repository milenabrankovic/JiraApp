<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->string('title');
            $table->text('description');   
            $table->bigInteger('project_id');
            $table->bigInteger('status_id');
            $table->bigInteger('user_id');
            $table->bigInteger('parent_id');
            $table->bigInteger('points');
            $table->bigInteger('sprint_id');
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
        Schema::dropIfExists('task');
    }
}
