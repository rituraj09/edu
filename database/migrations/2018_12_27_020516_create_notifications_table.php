<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable(); 
            $table->string('heading',500)->nullable();  
            $table->string('main_content',2000)->nullable(); 
            $table->string('url_link',690)->nullable();  
            $table->integer('type');  //1= Link , 2 = Content Available    
            $table->string('image',120)->nullable();  
            $table->integer('is_publish')->default(0);   
            $table->integer('is_new')->default(1);    
            $table->integer('status')->default(1);    
            $table->integer('created_by')->nullable(); 
            $table->integer('updated_by')->nullable(); 
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
        Schema::dropIfExists('notifications');
    }
}
