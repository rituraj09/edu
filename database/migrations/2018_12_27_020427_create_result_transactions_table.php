<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('result_id',false, true); 
            $table->integer('student_id',false, true);   
            $table->integer('marks');   
            $table->integer('out_of');   
            $table->unsignedDecimal('percentage', 3, 2)->default(0);   
            $table->string('grade');   
            $table->string('result');   //P=Pass, F=Fail
            $table->string('remarks',1000)->nullable();    
            $table->foreign('result_id')->references('id')->on('results');
            $table->foreign('student_id')->references('id')->on('master_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_transactions');
    }
}
