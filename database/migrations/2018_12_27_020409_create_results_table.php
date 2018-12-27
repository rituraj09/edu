<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id',false, true);  
            $table->string('session',20);    
            $table->date('publish_on');     
            $table->integer('is_publish')->default(0);    
            $table->integer('status')->default(1); 
            $table->integer('created_by')->nullable(); 
            $table->integer('updated_by')->nullable();   
            $table->timestamps();
            $table->foreign('section_id')->references('id')->on('master_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
