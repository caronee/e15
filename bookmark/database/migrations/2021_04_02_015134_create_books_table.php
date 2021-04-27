<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('slug');
            $table->string('title');
           
            $table->smallInteger('published_year');
            $table->string('cover_url')->nullable(); # Here we use a column modifier to specify this column can be left empty (null)
            $table->string('info_url');
            $table->string('purchase_url');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}