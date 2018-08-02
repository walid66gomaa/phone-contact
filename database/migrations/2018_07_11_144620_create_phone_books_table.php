<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
          // $table->string('url')->default('null');
            
            $table->string('email')->default('null');
            $table->integer('phone');
            $table->integer('userid');
           

           
            
      
            $table->timestamps();
        });
        DB::statement("ALTER TABLE phone_books ADD url LONGBLOB  null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_books');
    }
}
