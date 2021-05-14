<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecimensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specimens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->string('IMA_reference');
            //$table->string('display_name')->nullable();
            //$table->string('country');
            $table->string('comments')->nullable();

            $table->string('catalogue_entry')->nullable();
            $table->string('type_status')->nullable();
            $table->char('T')->default(0);

            $table->char('CT')->default(0);
            
            $table->char('HT')->default(0);
            $table->char('NT')->default(0);
            $table->char('PT')->default(0);
            $table->char('AT')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specimens');
    }
}