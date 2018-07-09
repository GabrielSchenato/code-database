<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Description of CreateCodeCategoriesTable
 *
 * @author gabriel
 */
class CreateCodeTagsTable extends Migration
{

    public function up()
    {
        Schema::create('codepress_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('codepress_tags');
    }

}
