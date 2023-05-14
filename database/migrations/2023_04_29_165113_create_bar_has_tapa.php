<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_has_tapa', function (Blueprint $table) {
            $table->engine="innoDB";
            $table->id();            
            $table->unsignedBigInteger('tapa_id');
            $table->unsignedBigInteger('bar_id');            
            $table->timestamps();

            //$table->primary(['tapa_id', 'bar_id']);

            $table->foreign('bar_id')->references('id')->on('bars')->onDelete('cascade');
            $table->foreign('tapa_id')->references('id')->on('tapas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bar_has_tapa');
    }
};
