<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeGroupMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_group_mappings', function (Blueprint $table) {
            $table->bigInteger('product_attribute_id')->index('product_attribute_index');
            $table->bigInteger('product_attribute_group_id')->index('product_attribute_group_index');
        });
        \Illuminate\Support\Facades\DB::statement('alter table `product_attribute_group_mappings` comment "mapping product_attributes and product_attribute_groups"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_group_mappings');
    }
}
