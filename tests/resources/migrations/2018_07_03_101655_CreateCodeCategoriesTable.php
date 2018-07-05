<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Description of CreateCodeCategoriesTable
 *
 * @author gabriel
 */
class CreateCodeCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('codepress_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('codepress_categories');
    }

}
