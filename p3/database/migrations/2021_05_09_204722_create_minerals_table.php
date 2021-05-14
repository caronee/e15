<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMineralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minerals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug')->onDelete('cascade');
            $table->string('IMA_reference')->nullable();
            $table->smallInteger('published_year', )->nullable();

            $table->string('author')->nullable();
            $table->string('publication')->nullable();
            $table->string('publication_url')->nullable();

            $table->string('locality')->nullable();
            $table->string('formula')->nullable();
            $table->string('comments')->nullable();


            //Species Name	IMA Ref	Repository	Country
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minerals');
    }
}