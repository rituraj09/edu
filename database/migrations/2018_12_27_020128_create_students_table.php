<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');    
            $table->string('sys_id');
            $table->integer('section_id',false, true); 
            $table->string('batch_number', 20)->nullable();     
            $table->string('roll_number');      
            $table->string('name');      
            $table->string('fathers_name', 120)->nullable();      
            $table->string('mothers_name', 120)->nullable();       
            $table->date('birth_date')->nullable();        
            $table->string('permanent_address', 200)->nullable();       
            $table->string('pin_code', 6)->nullable();       
            $table->string('mobile', 14)->nullable();          
            $table->string('email', 70)->nullable();     
            $table->string('remarks', 1000)->nullable();          
            $table->boolean('is_active')->default(1); 
            $table->boolean('status')->default(1); 
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
        Schema::dropIfExists('students');
    }
}
