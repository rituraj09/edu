<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial');
            $table->integer('class_id',false, true); 
            $table->string('name');      
            $table->boolean('is_active')->default(1); 
            $table->boolean('status')->default(1); 
            $table->integer('created_by')->nullable(); 
            $table->integer('updated_by')->nullable(); 
            $table->timestamps(); 
            $table->foreign('class_id')->references('id')->on('master_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_sections');
    }
}
