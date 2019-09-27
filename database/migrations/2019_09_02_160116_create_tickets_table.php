<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('summary');
            $table->string('description');
            $table->integer('issuecategory_id');
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->integer('prority')->default(0);
            $table->boolean('status')->default(0);
            $table->string('related')->nullable();
            $table->string('resolution')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
