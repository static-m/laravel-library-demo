<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('isbn')->nullable();
            $table->string('genre')->nullable();
            $table->text('abstract')->nullable();
            $table->dateTime('published_on')->nullable();
            $table->string('author_email')->nullable();
            $table->integer('pages')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('published_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
