<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
        });


        // Default values.
        DB::table('categories')->insert([
            ['category' => 'Science'], 
            ['category' => 'Language'], 
            ['category' => 'Computer science'],
            ['category' => 'English'],
            ['category' => 'Math'],
            ['category' => 'Design'],
            ['category' => 'Economics'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
