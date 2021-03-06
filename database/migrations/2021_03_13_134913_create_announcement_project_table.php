<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('announcement_id');
            $table->foreign('announcement_id')->on('announcements')->references('id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->on('projects')->references('id');
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
        Schema::dropIfExists('announcement_project');
    }
}
