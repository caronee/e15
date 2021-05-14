<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectMineralsAndSpecimens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specimens', function (Blueprint $table) {

        # Remove the field associated with the old way we were storing authors
            # Can do this here, or update the original migration that creates the `books` table
            # $table->dropColumn('author');

            # Add a new bigint field called `author_id`
            # has to be unsigned (i.e. positive)
            # nullable so it's possible to have a book without an author
            $table->bigInteger('mineral_id')->unsigned()->nullable();

            # This field `author_id` is a foreign key that connects to the `id` field in the `authors` table
            $table->foreign('mineral_id')->references('id')->on('minerals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specimens', function (Blueprint $table) {

        # ref: http://laravel.com/docs/migrations#dropping-indexes
            # combine tablename + fk field name + the word "foreign"
            $table->dropForeign('specimens_mineral_id_foreign');

            $table->dropColumn('mineral_id');
        });
    }
}