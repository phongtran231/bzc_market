<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->default(0)->nullable()->index()->comment('Category parent');
            $table->string('title')->comment('Title');
            $table->string('des')->comment('Description');
            $table->string('cat_name')->index()->nullable()->comment('Code of category');
            $table->string('icon')->nullable()->comment('Icon of category');
            $table->text('content')->nullable()->comment('Content of category');
            $table->softDeletes();
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
        Schema::dropIfExists('product_categories');
    }
}
