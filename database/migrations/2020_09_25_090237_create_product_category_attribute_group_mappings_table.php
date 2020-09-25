<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryAttributeGroupMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_attribute_group_mappings', function (Blueprint $table) {
            $table->bigInteger('product_category_id')->index('product_category_index');
            $table->bigInteger('product_attribute_group_id')->index('product_attribute_group_index');
        });
        \Illuminate\Support\Facades\DB::statement('alter table `product_category_attribute_group_mappings` comment "mapping product_categories and product_attribute_groups"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category_attribute_group_mappings');
    }
}
