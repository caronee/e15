<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookUserTable extends Migration
{
    public function up()
    {
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            # `book_id` and `user_id` will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # `book_id` will reference the `books` table and `user_id` will reference the `users` table.
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            # Make foreign keys
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('user_id')->references('id')->on('users');

            # (Optional) Add additional columns for data you want to associate with this relationship
            $table->text('notes')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_user');
    }
}